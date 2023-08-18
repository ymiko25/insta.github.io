<div class="modal fade" id="hide-post-{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
             <div class="modal-header border-danger">
                <h3 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-user-slash"></i> Hide
                </h3>
             </div>

             <div class="modal-body">
                  Are you sure want to delete this post?
                  <div class="mt-3">
                       <img src="{{ $post->image}}" alt="post id {{$post->id}}" class="image-lg">
                       <p class="mt-1 text-muted">{{"$post->description"}}</p>
                  </div>
             </div>

             <div class="modal-footer border-0">
                 <form action="{{ route('admin.posts.hide', $post->id) }}" method="post">
                      @csrf
                      @method('DELETE')

                      <button class="btn btn-outline-danger btn-sm" type="button" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-danger btn-sm">Hide</button>
                 </form>
             </div>
        </div>
    </div>
</div>


<div class="modal fade" id="visible-post-{{ $post->id }}">
    <div class="modal-dialog">
         <div class="modal-content border-success">
             <div class="modal-header border-success">
                 <h3 class="h5 modal-title text-success">
                    <i class="fa-solid fa-user-slash"></i> Visible
                 </h3>
             </div>
            <div class="modal-body"> 
               Are you sure want to Visible?
            </div>

            <div class="modal-footer border-0">
               <form action="{{ route('admin.posts.visible', $post->id) }}" method="post">
                   @csrf
                   @method('PATCH')
                   <button class="btn btn-outline-success btn-sm" type="button" data-bs-dismiss="modal">Cancel</button>
                   <button type="submit" class="btn btn-success btn-sm">Visible</button>
               </form>
            </div>
         </div>
    </div>
</div>