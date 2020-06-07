<template>
    <div>
        <div class="progress" v-show="form.busy">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="box mt-4 ml-2">
            <div class="box-header d-flex justify-content-between mb-3">
                <h3 class="box-title">All Users</h3>
                <button class="btn btn-success" @click="newUserModal">Create User <i class="fa fa-plus"></i></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email address</th>
                    <th>Registered At</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users">
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.created_at | date }}</td>
                    <td>{{user.type }}</td>
                    <td>
                        <a href="#" @click="editUserModal(user)">Edit <i class="fa fa-edit mr-2"></i></a>
                        <a href="#" @click="deleteUser(user.id)" class="red">Delete <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                </tr>
                </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
            
            <!-- MOdal  -->
            <div class="modal" id="createuser" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ mode }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="mode == 'Create User' ? addUser(): updateUser()" @keydown="form.onKeydown($event)">
                    <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"
                                    class="form-control" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.email" type="email" name="email"
                                    class="form-control" placeholder="Email Address" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.password" type="password" name="password"
                                    class="form-control" placeholder="Password" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>

                            <div class="form-group">
                                <textarea v-model="form.bio" name="bio"
                                    class="form-control" placeholder="Bio (optional)" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>

                            <div class="form-group">
                                <select name="type" v-model="form.type" id="type" class="form-control" :class="{'is-invalid': form.errors.has('type') }">
                                    <option value="">Choose Type</option>        
                                    <option value="user">User</option>        
                                    <option value="admin">Admin</option>        
                                    <option value="writer">Writer</option>        
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button :disabled="form.busy" type="submit" class="btn btn-primary">{{ mode }}</button>
                    </div>
                    </form>

                    </div>
                </div>
            </div>
            <!-- end of modal  -->
        </div>
    </div>
    <!-- /.box -->
</template>

<script>
import Vue from 'vue'
import axios from 'axios'

export default {
    data () {
        return {
            form: new Form({
                id: '',
                name: '',
                password: '',
                email: '',
                bio: '',
                type: '',
                photo: '',
            }),
            users: {},
            mode: ''
        }
    },
    mounted() {
        this.loadUsers()
    },
    methods: {
        loadUsers() {
            axios.get('/api/admin/users')
                .then((response) => {
                    this.users = response.data.data
                }).catch((err) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Cannot Fetch Users'
                    })
                })
        },
        addUser() {
            this.form.post('/api/admin/users')
                .then(({data}) => {
                    $('#createuser').modal('hide')
                    this.loadUsers()
                    Toast.fire({
                        icon: 'success',
                        title: 'Created Successfully!'
                    })
                }).catch((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong'
                    })
                })
        },
        updateUser() {
            this.form.put('/api/admin/users/' + this.form.id)
                .then(() => {
                    $('#createuser').modal('hide')
                    this.loadUsers()
                    Toast.fire({
                        icon: 'success',
                        title: 'Updated Successfully!'
                    })
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong'
                    })
                })
        },
        deleteUser(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {
                    this.form.delete('/api/admin/users/' + id)
                        .then(() => {
                            this.loadUsers()
                            Swal.fire(
                                'Deleted!',
                                'User Deleted Successfully!',
                                'success'
                            )
                        }).catch(() => {
                            Swal.fire(
                                'Something went wrong',
                                'Try again later',
                                'error'
                            )
                        })
                    
                }
            })
        },
        newUserModal() {
            this.mode = "Create User"
            this.form.reset()
            $('#createuser').modal('show')
        },
        editUserModal(user) {
            this.mode = "Update User"
            this.form.fill(user)
            $('#createuser').modal('show')
        }
    }
}
</script>
