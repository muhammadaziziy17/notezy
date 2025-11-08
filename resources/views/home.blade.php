@extends('layouts.app')

@section('content')
    <div class=" overflow-y-auto overflow-x-auto cards_container w-full min-h-screen flex justify-center items-start ">
        <div class="row justify-content-center cards_home">
            @foreach ($notes as $note)
                <a href="{{ route('get_note_more', ['id' => $note->id]) }}" target="_blank">
                    <div id="note_card{{ $note->id }}"
                        class="note_type_{{ $note->note_type }} rounded-x1 note_card group bg-base-100 shadow-lg border-2 border-base-200/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col cursor-pointer">

                        <div class="p-5 flex flex-col flex-grow">

                            <div class="flex items-start mb-2 gap-3">

                                <div class="w-3 h-3 mt-2 rounded-full bg-{{ $note->note_type }} flex-shrink-0"
                                    title="{{ ucfirst($note->note_type) }}"></div>

                                <h2
                                    class="text-xl font-bold text-base-content leading-snug line-clamp-2 group-hover:text-primary transition-colors duration-200 flex-grow">
                                    {{ Str::limit($note->note_title, 5, '...') ?? 'Sarlavhasiz eslatma' }}
                                </h2>
                            </div>

                            <p class="text-sm text-base-content/70 mb-4 line-clamp-3 leading-relaxed flex-grow">
                                {{ Str::limit($note->note_text, 150, '...') }}
                            </p>

                            <div class="mt-auto pt-3 border-t border-base-200">
                                @if ($note->created_at->eq($note->updated_at))
                                    <p class="text-xs text-base-content/50">
                                        <span class="font-semibold text-primary">Saqlangan:</span>
                                        {{ $note->created_at->diffForHumans() }}
                                    </p>
                                @else
                                    <p class="text-xs text-base-content/60">
                                        <span class="font-semibold text-warning">Yangilangan:</span>
                                        {{ $note->updated_at->diffForHumans() }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <dialog id="noteModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300 z-50">
        <div
            class="modal-box w-11/12 max-w-3xl transform transition-transform duration-300 scale-90 bg-white rounded-xl p-6">
            <h3 class="font-bold text-lg mb-4" id="modal-title">Eslatmani ko'rish</h3>

            <form id="modal-form" method="POST">
                @csrf
                <input type="hidden" name="note_id" id="modal-note-id">

                <div class="mb-3">
                    <label class="label">Sarlavha</label>
                    <input type="text" name="new_note_title_value" id="modal-title-input"
                        class="input input-bordered w-full">
                </div>

                <div class="mb-3">
                    <label class="label">Matn</label>
                    <textarea name="new_note_text_value" id="modal-text-input" class="textarea textarea-bordered w-full h-40"></textarea>
                </div>

                <div class="mb-3">
                    <label class="label">Tur</label>
                    <select name="new_note_type_value" id="modal-type-input" class="select select-bordered w-full">
                        <option value="primary">Shaxsiy</option>
                        <option value="success">O'qish</option>
                        <option value="secondary">Ish/Loyihalar</option>
                        <option value="warning">Xarid/Moliyaviy</option>
                        <option value="success-content">Boshqalar</option>
                    </select>
                </div>

                <div class="modal-action flex justify-between mt-6">
                    <button type="button" class="btn btn-error" id="closeNoteModal">Yopish</button>
                    <span id="note_more_edit_button">
                        <button class="btn btn-warning col-lg-2 m-2" type="button" id="note_value_change">Saqlash</button>
                    </span>
                    <a href="#" class="btn btn-dark" id="archive-link">Arxivlash</a>
                </div>
            </form>
        </div>
    </dialog>




    @if (session('note_updated'))
        <script>
            Toastify({
                text: "{{ session('note_updated') }}",
                className: "warning",
                position: 'center',
                gravity: 'top',
                style: {
                    background: "linear-gradient(120deg, #f6d365 0%, #fda085 100%)",
                }
            }).showToast();
        </script>
    @endif
    @if (session('note_archived'))
        <script>
            Toastify({
                text: "{{ session('note_archived') }}",
                className: "info",
                position: 'center',
                gravity: 'top',
                style: {
                    background: "linear-gradient(15deg, #13547a 0%, #80d0c7 100%)",
                }
            }).showToast();
        </script>
    @endif
@endsection
@section('title')
    Bosh sahifa
@endsection
@section('app_btn_section')
    <!-- Qo‘shish tugmasi -->
    <button class="btn btn-primary fixed bottom-6 right-6 rounded-full shadow-lg z-50" onclick="add_note_modal.showModal()">
        <i class="fa-solid fa-plus text-lg"></i>
    </button>
    <dialog id="sort_note_modal" class="modal">
        <div class="modal-box relative">
            <h3 class="font-bold text-lg mb-4">Eslatmalarni sortlash</h3>

            <div class="form-control mb-3">
                <label class="label"><span class="label-text">Eslatma turi</span></label>
                <select id="note_sort_value" name="note_sort_value" class="select select-bordered w-full" required
                    onchange="sort_notes()">
                    <option value="primary">Shaxsiy</option>
                    <option value="success">O'qish</option>
                    <option value="secondary">Ish/Loyihalar</option>
                    <option value="warning">Xarid/Moliyaviy</option>
                    <option value="success-content">Boshqalar</option>
                </select>
            </div>
        </div>
    </dialog>

    <!-- Modal -->
    <dialog id="add_note_modal" class="modal">
        <div class="modal-box relative">
            <h3 class="font-bold text-lg mb-4">📝 Yangi eslatma qo'shish</h3>

            <div class="form-control mb-3">
                <label class="label"><span class="label-text">Sarlavha</span></label>
                <input type="text" id="note_title" class="input input-bordered w-full"
                    placeholder="Masalan: Dars rejalari" required />
            </div>

            <div class="form-control mb-3">
                <label class="label"><span class="label-text">Matn</span></label>
                <textarea id="note_text" class="textarea textarea-bordered w-full" placeholder="Eslatma matni..." required></textarea>
            </div>

            <div class="form-control mb-5">
                <label class="label"><span class="label-text">Turini tanlang</span></label>
                <select id="note_category" class="select select-bordered w-full">
                    <option value="primary">Shaxsiy</option>
                    <option value="success">O'qish</option>
                    <option value="secondary">Ish/Loyihalar</option>
                    <option value="warning">Xarid/Moliyaviy</option>
                    <option value="success-content">Boshqalar</option>
                </select>
            </div>

            <div class="modal-action">
                <button type="button" id="save_note_btn" class="btn btn-success w-full">Saqlash</button>
            </div>
        </div>
    </dialog>
    <script>
        const sort_modal = document.getElementById("sort_note_modal");
        const modal = document.getElementById("add_note_modal");
        sort_modal.addEventListener("click", (event) => {
            // agar bosilgan joy modal-box ichida bo‘lmasa
            const dialogBox = sort_modal.querySelector(".modal-box");
            if (!dialogBox.contains(event.target)) {
                sort_modal.close();
            }
        });
        modal.addEventListener("click", (event) => {
            // agar bosilgan joy modal-box ichida bo‘lmasa
            const dialogBox = modal.querySelector(".modal-box");
            if (!dialogBox.contains(event.target)) {
                modal.close();
            }
        });
    </script>
    <div class="container">
        <div class="app_btn_section">
            <!-- <div id="btn_section">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <button class="btn btn-info" type="button" id="dropdown_add_note_button" title="Eslatma qo'shish"><i class="fa-solid fa-plus"></i></button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <button class="btn btn-secondary" type="button" title="Menyu" onclick="toggle_menu_dropdown()"><i class="fa-solid fa-bars"></i></button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div> -->
            {{-- <div id="dropdown_add_note">
            <h5>Eslatma mavzusi</h5>
            <input type="text" id="note_title" class="form-control">
            <h5>Eslatma matni</h5>
            <textarea class="form-control" id="note_text"></textarea>
            <h5>Eslatma turi</h5>
            <select name="" id="note_category" class="form-select">
                <option value="primary">Shaxsiy (shaxsiy fikrlar,kundalik yozuvlar)</option>
                <option value="success">O'qish (konspektlar,uy vazifalari,kitobdan eslatmalar)</option>
                <option value="secondary">Ish/Loyihalar (topshiriqlar,ish rejalari)</option>
                <option value="warning">Xarid/Moliyaviy (xarid ro'yxati,byudjet eslatmalari)</option>
                <option value="light">Boshqalar (yuqoridagilarga kirmaydigan narsalar)</option>
            </select>
            <hr>
            <button class="btn btn-warning" id="save_note_btn">Saqlash</button>
        </div>
        <div id="menu_dropdown">
            <p>Saralash:</p>
            <select class="form-select" onchange="sort_notes()" id="note_sort_value">
                <option value="all">Hammasi</option>
                <option value="primary">Shaxsiy (shaxsiy fikrlar,kundalik yozuvlar)</option>
                <option value="success">O'qish (konspektlar,uy vazifalari,kitobdan eslatmalar)</option>
                <option value="secondary">Ish/Loyihalar (topshiriqlar,ish rejalari)</option>
                <option value="warning">Xarid/Moliyaviy (xarid ro'yxati,byudjet eslatmalari)</option>
                <option value="light">Boshqalar (yuqoridagilarga kirmaydigan narsalar)</option>
            </select>
            <hr>
            <p>Qolgan sahifalar:</p>
            <div class="list-group text-center">
                <a href="{{route('note_archives')}}" class="list-group-item list-group-item-action">Arxiv<i class="fa-solid fa-box-archive"></i></a>
            </div>
        </div>
    </div>
</div> --}}
        @endsection
