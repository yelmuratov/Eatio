<div class="container-fluid">
   <!-- row -->
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4 class="card-title">Categories</h4>
               <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">Add Category +</a>
            </div>
            <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-responsive-sm">
                        <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Name</th>
                                 <th>Description</th>
                                 <th>Created at</th>
                                 <th>Action</th>
                              </tr>
                        </thead>
                        <tbody>
                              @foreach($categories as $category)
                                 <tr>
                                    <th>{{$category->id}}</th>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->description}}</td>
                                    <td>{{$category->created_at}}</td>
                                    <td class="color-primary">
                                       <a href="#"><i class="fa fa-edit"></i></a>
                                       <a href="#" style="margin-left: 10px;" wire:click.prevent="deleteCategory({{$category->id}})"><i class="fa fa-trash"></i></a>
                                    </td>
                                 </tr>
                              @endforeach
                        </tbody>
                     </table>
                  </div>
            </div>
         </div>
      </div>
   </div>
</div>