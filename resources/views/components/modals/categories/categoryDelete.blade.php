<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title bg-danger" id="exampleModalLabel2">Si continuas eliminaras tambien los
                    productos
                    asociados</h5>
            </div>
            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                @csrf
                @method('DELETE')


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-danger ">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
