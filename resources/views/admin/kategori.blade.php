<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-g">
    <title>Manajemen Kategori</title>

    <style>
        body { font-family: sans-serif; background-color: #ffffff; margin: 0; padding: 0; }
        *, *::before, *::after { box-sizing: border-box; }
        .main-content-wrapper { background-color: #ffffff; padding: 60px; margin: 0; }
        .category-entry { padding-top: 20px; }
        .category-item-detail { display: flex; align-items: center; justify-content: space-between; padding: 15px; width: 100%; border-radius: 8px; background-color: #ffffff; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); margin-bottom: 15px; border: 1px solid #ddd; }
        .category-info-group { display: flex; align-items: center; gap: 10px; }
        .category-title { font-weight: bold; font-size: 1.1em; }
        .button { padding: 6px 18px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f8f8; cursor: pointer; font-size: 0.9em; transition: background-color 0.2s; }
        .button:hover { background-color: #e9e9e9; }
        .alert { padding: 15px; margin-top: 20px; border: 1px solid transparent; border-radius: 4px; }
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 1000; }
        .modal { position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #fff; width: 90%; max-width: 400px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); z-index: 1001; padding: 25px; }
        .modal-content { display: flex; flex-direction: column; }
        .modal-close { position: absolute; top: 10px; right: 15px; cursor: pointer; font-size: 28px; color: #aaa; }
        .modal-close:hover { color: #333; }
        .modal-title { margin-top: 0; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 1em; }
    </style>
</head>
<body>

@include('components.admin.navbar')

<div class="main-content-wrapper">
    
    <button type="button" id="add-category-btn" class="button">+ Tambah Kategori</button>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="category-entry">
        @forelse ($categories as $category)
            <div class="category-item-detail">
                <div class="category-info-group">
                    <div class="category-title">{{ $category->name }}</div>
                    <button type="button" class="button edit-btn" 
                            data-name="{{ $category->name }}"
                            data-url="{{ route('admin.categoryedit', $category->id) }}">
                        Edit
                    </button>
                    <form action="{{ route('admin.categorydelete', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p style="margin-top: 20px;">Belum ada kategori.</p>
        @endforelse
    </div>
</div>

<div class="modal-overlay" id="modal-overlay" style="display:none;"></div>
<div class="modal" id="form-modal" style="display:none;">
  <div class="modal-content">
    <span class="modal-close" id="modal-close-btn">&times;</span>
    <h2 class="modal-title" id="modal-title"></h2>
    <form id="modal-form" action="" method="POST">
        @csrf
        <div id="modal-method-field"></div>
        <div class="form-group">
            <label for="category-name">Nama Kategori</label>
            <input type="text" id="category-name" name="name" required autocomplete="off">
        </div>
        <button type="submit" class="button" id="modal-save-btn"></button>
    </form>
  </div>
</div>

@include('components.admin.footer')

<script>
document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('modal-overlay');
    const modal = document.getElementById('form-modal');
    const closeBtn = document.getElementById('modal-close-btn');
    const modalTitle = document.getElementById('modal-title');
    const modalForm = document.getElementById('modal-form');
    const modalMethodField = document.getElementById('modal-method-field');
    const categoryNameInput = document.getElementById('category-name');
    const saveBtn = document.getElementById('modal-save-btn');
    const addBtn = document.getElementById('add-category-btn');
    const editBtns = document.querySelectorAll('.edit-btn');

    const closeModal = () => {
        overlay.style.display = 'none';
        modal.style.display = 'none';
    };

    addBtn.addEventListener('click', () => {
        modalForm.action = "{{ route('admin.categoryadd') }}";
        modalMethodField.innerHTML = "";
        modalTitle.textContent = 'Tambah Kategori Baru';
        saveBtn.textContent = 'Simpan';
        categoryNameInput.value = '';
        overlay.style.display = 'block';
        modal.style.display = 'block';
        categoryNameInput.focus();
    });

    editBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const categoryName = btn.dataset.name;
            const updateUrl = btn.dataset.url;

            modalForm.action = updateUrl;
            modalMethodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
            modalTitle.textContent = 'Edit Kategori';
            saveBtn.textContent = 'Update';
            categoryNameInput.value = categoryName;
            overlay.style.display = 'block';
            modal.style.display = 'block';
            categoryNameInput.focus();
        });
    });

    closeBtn.addEventListener('click', closeModal);
    overlay.addEventListener('click', closeModal);
});
</script>

</body>
</html>