<template>
  <div class="py-4 px-2">

        <div class="progress" v-show="form.busy">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="box-header d-flex justify-content-between mb-3">
            <h3 class="box-title">All Permission</h3>
            <button class="btn btn-success" @click="newPermissionModal">Create Permission <i class="fa fa-plus"></i></button>
        </div>
      <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Permission Id</th>
                    <th>Permission Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="permission in permissions">
                    <td>{{ permission.id }}</td>
                    <td>{{ permission.name }}</td>
                    <td>
                        <a href="#" @click="editPermissionModal(permission)">Edit <i class="fa fa-edit mr-2"></i></a>
                        <a href="#" @click="deletePermission(permission.id)" class="red">Delete <i class="fa fa-trash"></i></a>
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


            <!-- Modal  -->
            <div class="modal" id="createpermission" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ mode }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="mode == 'Create Permission' ? addPermission(): updatePermission()" @keydown="form.onKeydown($event)">
                    <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"
                                    class="form-control" placeholder="Permission name" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
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
</template>

<script>
import axios from 'axios'
export default {
    data()  {
        return {
            form: new Form({
                id: '',
                name: '',
            }),
            permissions: {},
            mode: '',
        }
    },
    mounted() {
        this.loadPermissions()
    },
    methods: {
        deletePermission(id) {
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
                    this.form.delete('/api/admin/permissions/' + id)
                        .then(() => {
                            this.loadPermissions()
                            Swal.fire(
                                'Deleted!',
                                'Permission Deleted Successfully!',
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
        newPermissionModal() {
            this.mode = "Create Permission"
            this.form.reset()
            $('#createpermission').modal('show')
        },
        editPermissionModal(permission) {
            this.mode = "Update Permission"
            this.form.fill(permission)
            $('#createpermission').modal('show')
        },
        addPermission() {
            this.form.post('/api/admin/permissions')
                .then(({data}) => {
                    $('#createpermission').modal('hide')
                    this.loadPermissions()
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
        updatePermission() {
            this.form.put('/api/admin/permissions/' + this.form.id)
                .then(() => {
                    $('#createpermission').modal('hide')
                    this.loadPermissions()
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
        loadPermissions() {
            axios.get('/api/admin/permissions')
                .then((response) => {
                    this.permissions = response.data
                })
        }
    }
}
</script>

<style>

</style>