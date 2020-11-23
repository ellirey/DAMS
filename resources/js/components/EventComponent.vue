<template>
    <div class="container">
        <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DOST Events</h3>

              <div class="card-tools">
                  <button class="btn btn-success" data-toggle="modal" data-target="#addNew">
                      Add New Event <i class="fas fa-calendar-plus"></i>
                  </button>
                
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Event Title</th>
                    <th>Requesting Agency</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Description</th>
                    <th>Modify</th>
                  </tr>
              

                  <tr v-for ="event in events" :key="event.id">
                  <td>{{event.id}}</td>
                  <td><a href="">{{event.title}}</a></td>
                  <td>{{event.agencyID}}</td>
                  <td>{{event.dateFrom}}</td>
                  <td>{{event.dateTo}}</td>
                  <td>{{event.description}}</td>
                  <td>
                      <a href="#">
                          <i class="fa fa-edit blue"></i>
                      </a>
                  </td>
                </tr>
              </tbody></table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="addNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewLabel">Add New Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Start of Form -->
            <form @submit.prevent="createEvent">
            <div class="modal-body">
              <!--Title-->
              <label>Title</label>
                <div class="form-group">
                <input v-model="form.title" type="text" name="title"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                <has-error :form="form" field="title"></has-error>
              </div>

              <!-- Requesting Agency -->
                <label>Requesting Agency</label>
                <div class="form-group">
                <select v-model="form.agency" type="text" name="agency"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('agency') }">
                   <option>Select an agency</option>
                   <option v-for="agency in agencies" v-bind:key="agency.id" v-bind:value="agency.id">{{agency.agency}}</option>
                </select>

                <has-error :form="form" field="agency"></has-error>
              </div>

              <!-- Region -->
              <label>Region</label>
                <div class="form-group">
                <select v-model="form.region" type="text" name="region"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('region') }">
                   <option>Select a region</option>
                   <option v-for="region in regions" v-bind:key="region.id" v-bind:value="region.id">{{region.region}}</option>
                </select>
                <has-error :form="form" field="region"></has-error>
              </div>

              <!-- Date From and Date To -->
              <div class="row" >
                <div class="form-group col-md-6">
                    <label>From</label>
                    <input v-model="form.dateFrom" type="date" name="dateFrom"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('dateFrom') }">
                    <has-error :form="form" field="dateFrom"></has-error> 
                </div>
                <div class="form-group col-md-6">
                    <label>To</label>
                    <input v-model="form.dateTo" type="date" name="dateTo"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('dateTo') }">
                    <has-error :form="form" field="dateTo"></has-error> 
                </div>
              </div>
              <!--Description-->
              <label>Event Description</label>
                <div class="form-group">
                <textarea v-model="form.description" type="textarea" name="description"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                <has-error :form="form" field="description"></has-error>
              </div>

            <!--End of Modal Body  -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </form>
            <!-- End of Form -->
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {

      data(){
        return{
          agencies : [],
          events : [],
          regions : [],
          form: new Form({
            title : '',
            dateFrom : '',
            dateTo : '',
            description : '',
            agency : '',
            region : ''
          })
        }
      },
      methods: {
        createEvent(){
          this.form.post('api/events')
        },
        loadEvents(){
          axios.get("api/events").then(({data})=>(this.events= data));
          axios.get("api/agencies").then(({data})=>(this.agencies = data));
          axios.get("api/regions").then(({data})=>(this.regions = data));
          
        } 
      },
      created() {
          this.loadEvents();
      }
      
    }
</script>
