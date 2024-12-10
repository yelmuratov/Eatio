<div class="container-fluid">
    <!-- Foods Table -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Foods</h4>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addFoodModal">Add Food +</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="foodsTable" class="table table-responsive-sm">
                            <input type="text" class="form-control" placeholder="Search Foods..." wire:model.debounce.500ms="searchTerm">
                            <h1>{{$searchTerm}}</h1>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach($foods as $food)
                                    <tr>
                                        <th>{{ $food->id }}</th>
                                        <td>{{ $food->name }}</td>
                                        <td>
                                            @foreach($categories as $category)
                                                @if($category->id == $food->category_id)
                                                    {{ $category->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $food->description }}</td>
                                        <td>{{ $food->price }}$</td>
                                        <td>
                                            <img src="{{ asset('storage/photos/' . $food->image) }}" width="60" data-toggle="modal" data-target="#viewImageModal{{ $food->id }}" style="cursor: pointer;" />
                                        </td>
                                        <td class="color-primary">
                                            <a href="#" data-toggle="modal" data-target="#editFoodModal" wire:click.prevent="editFood({{ $food->id }})"><i class="fa fa-edit"></i></a>
                                            <a href="#" style="margin-left: 10px;" wire:click.prevent="deleteFood({{ $food->id }})">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Controls -->
                    <div id="paginationControls" class="mt-3 text-center"></div>
                </div>
            </div>
        </div>
    </div>

    @foreach($foods as $food)
        <!-- View Image Modal -->
        <div id="viewImageModal{{ $food->id }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Image Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('storage/photos/' . $food->image) }}" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Edit Food Modal -->
    <div id="editFoodModal" class="modal fade" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Food</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-left">
                    <form wire:submit.prevent="updateFood" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" wire:model="name" placeholder="Name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                                <select class="form-control" wire:model="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" wire:model="description" placeholder="Description"></textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" wire:model="price" placeholder="Price">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" wire:model="image">
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" width="60" />
                                @endif
                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Food Modal -->
    <div id="addFoodModal" class="modal fade" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Food</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body text-left">
                    <form wire:submit.prevent="addFood" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" wire:model="name" placeholder="Name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                                <select class="form-control" wire:model="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" wire:model="description" placeholder="Description"></textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" wire:model="price" placeholder="Price">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" wire:model="image">
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" width="60" />
                                @endif
                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const rowsPerPage = 5; // Number of rows to display per page
    let currentPage = 1;

    const tableBody = document.getElementById('tableBody');
    const paginationControls = document.getElementById('paginationControls');
    const rows = Array.from(tableBody.children); // All rows

    const totalPages = Math.ceil(rows.length / rowsPerPage);

    function renderRows() {
        tableBody.innerHTML = '';
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        const rowsToDisplay = rows.slice(start, end);
        rowsToDisplay.forEach(row => tableBody.appendChild(row));
    }

    function renderPaginationControls() {
        paginationControls.innerHTML = '';
        const maxVisiblePages = 5; // Maximum number of visible page buttons

        const createButton = (text, page, isActive = false, isEllipsis = false) => {
            const button = document.createElement('button');
            button.textContent = text;
            button.classList.add('btn', 'btn-sm', 'mx-1');
            button.classList.add(isActive ? 'btn-primary' : 'btn-outline-primary');

            if (isEllipsis) {
                button.disabled = true;
                button.style.cursor = 'default';
            } else {
                button.addEventListener('click', () => {
                    currentPage = page;
                    renderRows();
                    renderPaginationControls();
                });
            }

            paginationControls.appendChild(button);
        };

        // Previous button
        if (currentPage > 1) {
            createButton('Previous', currentPage - 1);
        }

        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        if (startPage > 1) {
            createButton(1, 1);
            if (startPage > 2) createButton('...', null, false, true);
        }

        for (let i = startPage; i <= endPage; i++) {
            createButton(i, i, i === currentPage);
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) createButton('...', null, false, true);
            createButton(totalPages, totalPages);
        }

        // Next button
        if (currentPage < totalPages) {
            createButton('Next', currentPage + 1);
        }
    }

    renderRows();
    renderPaginationControls();
});

</script>
