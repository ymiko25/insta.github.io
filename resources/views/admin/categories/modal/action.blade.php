<div class="modal fade" id="edit-category-{{ $category->id }}">
    <div class="modal-dialog">
         <form action="{{ route('admin.categories.update', $category->id)}}" method="post">
             @csrf
             @method('PATCH')
             <div class="modal-content border-warning">
                  <div class="nodal-header border-warning">
                      <h3 class="h5 modal-title">
                         <i class="fa-regular fa-pen-to-square"></i> Edit Category
                      </h3>
                  </div>

                  <div class="modal-body">
                      <input type="text" name="new_name" class="form-control" placeholder="category name" value="{{ $category->name }}">
                  </div>
                  <div class="modal-footer border-0">
                     <button class="btn btn-outline-warning btn-sm" type="button" data-bs-dismiss="modal">Cancel</button>
                     <button class="btn btn-warning btn-sm" type="submit">Update</button>
                  </div>
             </div>
         </form>
    </div>
</div>


