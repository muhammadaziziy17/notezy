<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Models\Note;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function __construct()
    {
        // Bu joyda `auth` middleware qo'shiladi. 
        // Foydalanuvchi tizimga kirmagan bo'lsa, avtomatik login sahifasiga o'tkaziladi
        $this->middleware('auth');
    }
    public function home()
    {
        return view('home', ['notes' => Note::where('user_id', Auth::user()->id)->where('is_deleted', 'not_active')->latest()->get()]);
    }
    // eslatmani ajaxda bazaga saqlash
    public function save_note(Request $note)
    {
        $note->validate([
            'note_title' => 'required',
            'note_text' => 'required',
            'note_type' => 'required',
        ]);
        $new_note = new Note();
        $new_note->note_title = $note->note_title;
        $new_note->note_text = $note->note_text;
        $new_note->note_type = $note->note_type;
        $new_note->user_id = Auth::user()->id;
        $new_note->save();
        return response()->json('saved');
    }
    // eslatmani id si buyicha toliq korish
    public function get_note_more($id)
    {
        $note = Note::findOrFail($id);
        return view('note_more', ['note' => $note]);
    }
    // eslatmani toliq korish sahifasi orqali bazadan ozgartirish
    public function note_update(Request $request)
    {
        $note = Note::find($request->note_id);
        if ($note->user_id == Auth::user()->id) {
            $note->note_title = $request->new_note_title_value;
            $note->note_text = $request->new_note_text_value;
            $note->note_type = $request->new_note_type_value;
            $note->save();
            return redirect()->route('home')->with('note_updated', 'Eslatma o`zgartirildi');
        } else {
            return redirect()->back();
        }
    }
    // eslatmani id si buyicha arxivlash
    public function archive_note_by_id(Request $request)
    {
        $note = Note::find($request->route('id'));
        if ($note->user_id == Auth::user()->id) {
            $note->is_deleted = 'active';
            $note->save();
        } else {
            return redirect()->back();
        }
        return redirect()->route('home')->with('note_archived', 'Eslatma arxivlandi ✅');
    }
    // arxivlangan eslatmalar
    public function note_archives()
    {
        return view('archive', ['archived_notes' => Note::where('user_id', Auth::user()->id)->where('is_deleted', 'active')->get()]);
    }
    public function view_archived_note(Request $request)
    {
        $note = Note::find($request->route('id'));
        return view('view_archived_note', ['archived_note' => $note]);
    }
    public function restore_archived_note(Request $request)
    {
        $note = Note::find($request->route('id'));
        echo $note->user_id;
        echo Auth::user()->id;
        if ($note->user_id == Auth::user()->id) {
            $note->is_deleted = 'not_active';
            $note->save();
        } else {
            return redirect()->back();
        }
        return redirect()->route('note_archives')->with('note_unarchived', 'Eslatma arxivdan chiqarildi ‼️');
    }
    // arxivni tozalash
    public function clean_archive(Request $request)
    {
        DB::table('notes')->where('user_id', Auth::user()->id)->where('is_deleted', 'active')->delete();
        return redirect()->route('note_archives')->with('note_archive_cleaned', 'Arxiv tozalandi !');
    }
}
