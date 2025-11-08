<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Auth::routes();
Route::get('/', function () {
    return redirect('/login');
});
// bosh sahifaga otish
Route::get('/home', [NoteController::class, 'home'])->name('home');
// eslatmani saqlash ajaxda 
Route::post('/save-note', [NoteController::class, 'save_note'])->name('save_note');
// eslatmani id si buyicha toliq korish
Route::get('/get-note-more{id}', [NoteController::class, 'get_note_more'])->name('get_note_more');
// eslatmani toliq korish sahifasi orqali bazadan ozgartirish
Route::post('/note-update', [NoteController::class, 'note_update'])->name('note_update');
// eslatmani arxivlash id si buyicha
Route::get('/archive-note-by-id{id}', [NoteController::class, 'archive_note_by_id'])->name('archive_note_by_id');
// arxiv sahifasiga otish
Route::get('/archives', [NoteController::class, 'note_archives'])->name('note_archives');
// arxivdegi eslatmani toliq korish
Route::get('/view-archived-note{id}', [NoteController::class, 'view_archived_note'])->name('view_archived_note');
// eslatmani arxivdan tiklash
Route::get('/restore-archived-note{id}', [NoteController::class, 'restore_archived_note'])->name('restore_archived_note');
// arxivni tozalash
Route::post('/clean-archive', [NoteController::class, 'clean_archive'])->name('clean_archive');
