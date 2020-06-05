<template>
    <div>
        <div class="progress" v-show="form.busy">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="box mt-4 ml-2">
            <div class="box-header d-flex justify-content-between mb-3">
                <h3 class="box-title">All Users</h3>
                <button class="btn btn-success" data-toggle="modal" data-target="#createuser">Create User <i class="fa fa-plus"></i></button>
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
                        <a href="">Edit <i class="fa fa-edit mr-2"></i></a>
                        <a href="" class="red">Delete <i class="fa fa-trash"></i></a>
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
                        <h5 class="modal-title">Create User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="addUser" @keydown="form.onKeydown($event)">
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
                                    <option value="author">Author</option>        
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button :disabled="form.busy" type="submit" class="btn btn-primary">Save user</button>
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
                name: '',
                password: '',
                email: '',
                bio: '',
                type: '',
                photo: '',
            }),
            users: {},
        }
    },
    mounted() {
        this.loadUsers()
    },
    methods: {
        addUser() {
            this.form.post('/api/users')
                .then(({data}) => {
                    $('#createuser').modal('hide')
                    this.users.push(data)
                })
        },
        loadUsers() {
            axios.get('api/users')
                .then((response) => {
                    this.users = response.data.data
                }).catch((err) => {
                    console.log(err)
                })
        }
    }
}
</script>
