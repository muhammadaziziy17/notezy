@extends('layouts.app')

@section('content')
    <div class=" overflow-y-auto overflow-x-auto cards_container w-full min-h-screen flex justify-center items-start ">
        <div class="row justify-content-center cards_home">
            @foreach ($archived_notes as $note)
                <a target="_blank" href="{{ route('view_archived_note', ['id' => $note->id]) }}">
                    <div id="note_card{{ $note->id }}"
                        class="note_card group bg-base-200/70 border border-base-300 rounded-xl shadow-inner 
               hover:shadow-lg hover:bg-base-300/50 transition-all duration-300 
               flex flex-col cursor-pointer relative overflow-hidden"
                        style="height: 200px;" title="Sarlavha : {{ $note->note_title }}
Matn : {{ $note->note_text }}">

                        {{-- Arxiv belgisi (ikonka yoki yozuv) --}}
                        <div
                            class="absolute top-2 right-2 bg-warning/20 text-warning text-[10px] font-semibold px-2 py-1 rounded-full">
                            Arxivda
                        </div>

                        <div class="p-5 flex flex-col flex-grow">

                            <div class="flex items-start mb-2 gap-3">
                                <div class="w-3 h-3 mt-2 rounded-full bg-{{ $note->note_type }}"
                                    title="{{ ucfirst($note->note_type) }}"></div>

                                <h2
                                    class="text-lg font-semibold text-base-content/70 leading-snug line-clamp-2 
                           group-hover:text-primary transition-colors duration-200 flex-grow">
                                    {{ Str::limit($note->note_title, 40, '...') ?? 'Sarlavhasiz eslatma' }}
                                </h2>
                            </div>

                            <p class="text-sm text-base-content/60 mb-4 line-clamp-3 leading-relaxed flex-grow">
                                {{ Str::limit($note->note_text, 150, '...') }}
                            </p>

                            <div class="mt-auto pt-3 border-t border-base-300/70 text-xs text-base-content/50">
                                @if ($note->created_at->eq($note->updated_at))
                                    <span class="font-semibold text-primary/80">Saqlangan:</span>
                                    {{ $note->created_at->diffForHumans() }}
                                @else
                                    <span class="font-semibold text-warning/80">Yangilangan:</span>
                                    {{ $note->updated_at->diffForHumans() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

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
    Arxivlangan eslatmalar
@endsection
@section('app_btn_section')
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
