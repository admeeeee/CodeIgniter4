<div v-scope="container()" @vue:mounted="mounted">
  <button @click="showAdd()" class="btn btn-primary btn-xs">Add</button>
<table class="table">
  <thead >
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Fullname</th>
      <th scope="col">Email</th>
      <th scope="col" width="180px">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(d, index) in store.data">
      <td>{{((store.page-1)*store.perPage)+index+1}}</td>
      <td>{{d.username}}</td>
      <td>{{d.fullname}}</td>
      <td>{{d.email}}</td>
      <td>
          <button @click="showDetail(d)" class="btn btn-sm btn-primary">View</button>
          <button @click="showEdit(d)" class="btn btn-sm btn-warning">Edit</button>
          <button @click="del(d.user_id)" class="btn btn-sm btn-danger">Delete</button>
      </td>
    </tr>
  </tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
  
    <li :class ="{active :index == store.page}" v-for="index in store.totalPage" class="page-item">
        <a @click = "getData(index)" class="page-link" href="#">{{index}}</a>
    </li>
    
  </ul>

</nav>
<div id= "detailModal" class="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">User Detail</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>{{store.detail}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div style = "z-index:9999" id= "loading" class="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <br>
           <p>Loading....Please wait</p>
        <br>
      </div>
    </div>
  </div>
</div>

<div id= "addModal"class="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div v-show="store.e_error" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>
        <span v-for="err in store.a_error">{{err}}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
          <label for="">Username</label>
          <input type="text" class="form-control" name="username" v-model="store.a_username">
          <label for="">Password</label>
          <input type="text" class="form-control" name="password" v-model="store.a_password">
          <label for="">Fullname</label>
          <input type="text" class="form-control" name="fullname" v-model="store.a_fullname">
          <label for="">Email</label>
          <input type="text" class="form-control" name="email" v-model="store.a_email">
          <label for="">Role</label>
          <select name="role" class="form-control" v-model="store.a_role">
            <option value="1">Admin</option>
            <option value="2">User</option>
        </select>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" @click="insert()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div id= "editModal"class="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div v-show="store.e_error" class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>
        <span v-for="err in store.e_error">{{err}}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
          <label for="">Username</label>
          <input type="text" class="form-control" name="username" v-model="store.e_username">
          <label for="">Password</label>
          <input type="text" class="form-control" name="password" v-model="store.e_password">
          <label for="">Fullname</label>
          <input type="text" class="form-control" name="fullname" v-model="store.e_fullname">
          <label for="">Email</label>
          <input type="text" class="form-control" name="email" v-model="store.e_email">
          <label for="">Role</label>
          <select name="role" class="form-control" v-model="store.e_role">
            <option value="1">Admin</option>
            <option value="2">User</option>
        </select>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" @click="update()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</div>




<script type="module">
  import { createApp, reactive } from 'https://unpkg.com/petite-vue?module'

 const store = reactive({
     message:'hello from store',
     data :[],
     page : 1,
     perPage: '',
     totalPage: '',
     totalData: '',

     //detail
     detail : [],

     //edit
     e_id:'',
     e_username:'',
     e_password:'',
     e_fullname:'',
     e_email:'',
     e_role:'',
     e_error:'',

     //add
     //edit
    
     a_username:'',
     a_password:'',
     a_fullname:'',
     a_email:'',
     a_role:'',
     a_error:'',

 }) ;

  function container(){
      return {
          message: '',
          data: [], 

          getData(page){
              //$('#loading').modal('show');
              store.page = page;
              var self = this;
              $.post('/apiuser/list', {
                  page : store.page
              },function(res){
                //$('#loading').modal('hide');
                  self.store.data = res.data;
                  self.store.page = res.page;
                  self.store.perPage = res.perPage;
                  self.store.totalPage = res.totalPage;
                  self.store.totalData = res.totalData;
         
              });
          },

          showDetail(d){
               store.detail=d
               $('#detailModal').modal('show');
          },

          showAdd(){
               $('#addModal').modal('show');
          },

          showEdit(d){
               store.detail=d
               store.e_id=d.user_id;
               store.e_username =d.username;
               store.e_password=d.password;
               store.e_fullname=d.fullname;
               store.e_email=d.email;
               store.e_role=d.role;
               store.e_error='';
               $('#editModal').modal('show');
          },

          insert(){
            var self =this;
            $.post('/apiuser/change',{
                username:store.a_username,
                fullname:store.a_fullname,
                password:store.a_password,
                email:store.a_email,
                role:store.a_role,
            },function(res){
              if(res.error == 'yes'){
                Swal.fire(
                  'Error!',
                  'Something went wrong',
                  'error'
                );
                store.a_error=res.message;
              }else{
                Swal.fire(
                  'Insert!',
                  'User has been updated',
                  'success'
                );
                self.getData(1);
                $('#addModal').modal('hide');
              }
            });
          },


          update(){
            var self =this;
            $.post('/apiuser/change',{
                id:store.e_id,
                username:store.e_username,
                fullname:store.e_fullname,
                password:store.e_password,
                email:store.e_email,
                role:store.e_role,
            },function(res){
              if(res.error == 'yes'){
                Swal.fire(
                  'Error!',
                  'Something went wrong',
                  'error'
                );
                store.e_error=res.message;
              }else{
                Swal.fire(
                  'Update!',
                  'User has been updated',
                  'success'
                );
                self.getData(1);
                $('#editModal').modal('hide');
              }
            });
          },

          del(id){
            self=this;
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.post('/apiuser/remove',{
                id:id
              },function(res){
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              self.getData(1);      
              });
             
            }
          })
          },

          mounted(){
              this.getData(1);
              $('#loading').modal('show');
              store.message ='hello from store(updated)';
          }
      }
  }
  

  createApp({container, store}).mount()
</script>