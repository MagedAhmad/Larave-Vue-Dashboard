<template>
    <section class="content my-4 mx-2">
      <div class="container-fluid">
        <!-- <h5 class="mb-2">Info Box</h5> -->
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number">{{ countUsers }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <!-- <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Bookmarks</span>
                <span class="info-box-number">410</span>
              </div>
            </div>
          </div> -->
          <!-- /.col -->
          <!-- <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Uploads</span>
                <span class="info-box-number">13,648</span>
              </div>
            </div>
          </div> -->
          <!-- /.col -->
          <!-- <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">93,139</span>
              </div>
            </div>
          </div> -->
          <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
    </section>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            countUsers: 0,
        }
    },
    mounted() {
        axios.get('/api/admin/countUsers')
            .then((response) => {
                this.countUsers = response.data
            }).catch((error) => {
                Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong'
                    })
            })
    }
}
</script>
