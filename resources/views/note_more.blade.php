@extends('layouts.app')

@section('title')
    Eslatmani to'liq ko'rish
@endsection

@section('content')
    <div class="container mx-auto px-4 py-6" style="margin-top: 10vh;">
        <div class="flex justify-center">
            <div class="w-full max-w-3xl bg-base-100 rounded-xl shadow-md border border-base-300 p-6">
                <form action="{{ route('note_update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="note_id" value="{{ $note->id }}">

                    <!-- Sarlavha -->
                    <div class="mb-4">
                        <label class="label">
                            <span class="label-text font-semibold">Sarlavha</span>
                        </label>
                        <input type="text" name="new_note_title_value" id="new_note_title_value"
                            class="input input-bordered w-full" value="{{ $note->note_title }}" disabled />
                        <input type="hidden" id="old_note_title_value" value="{{ $note->note_title }}">
                    </div>

                    <!-- Matn -->
                    <div class="mb-4">
                        <label class="label">
                            <span class="label-text font-semibold">Matn</span>
                        </label>
                        <textarea id="new_note_text_value" name="new_note_text_value" class="textarea textarea-bordered w-full h-40" disabled>{{ $note->note_text }}</textarea>
                        <input type="hidden" id="old_note_text_value" value="{{ $note->note_text }}">
                    </div>

                    <!-- Tur -->
                    <div class="mb-6">
                        <label class="label">
                            <span class="label-text font-semibold">Tur</span>
                        </label>
                        <select id="new_note_type_value" name="new_note_type_value" class="select select-bordered w-full"
                            disabled required>
                            <option value="primary">Shaxsiy</option>
                            <option value="success">O'qish</option>
                            <option value="secondary">Ish/Loyihalar</option>
                            <option value="warning">Xarid/Moliyaviy</option>
                            <option value="success-content">Boshqalar</option>
                        </select>
                        <input type="hidden" id="old_note_type_value" value="{{ $note->note_type }}">
                    </div>
                    <div class="divider"></div>

                    <!-- Tugmalar -->
                    <div class="flex flex-wrap justify-center gap-4 mt-4">
                        <button type="button" onclick="window.close()" class="btn btn-error">Yopish</button>
                        <div id="note_more_edit_button">
                            <button type="button" class="btn btn-warning" id="note_value_change">
                                O‘zgartirish
                            </button>
                        </div>

                        <a href="{{ route('archive_note_by_id', ['id' => $note->id]) }}" class="btn btn-neutral"
                            title="Bu eslatma arxivlanadi">
                            Arxivlash
                            <i class="fa-solid fa-box-archive ml-1"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
