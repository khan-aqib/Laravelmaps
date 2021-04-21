<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Google Maps</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.2/css/bulma.min.css">
              <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .content {
                text-align: center;
            }

            
        </style>
    </head>
    <body>
        <div class="flex-top position-ref full-height">
             <div class="content">
                <div class="box">
                    <h1> Google Maps With laravel and Vue</h1>
                </div>
                  <div id="app" class="maps " >
                    <tile-spinner></tile-spinner>
                     <div class="container">
                       <div class="columns">
                        <div class="column box">
                                <gmap-map
                                    :center="mapCenter"
                                    :zoom="1"                                    
                                    style="width: 100%; height: 700px;">
                                   <gmap-info-window
                                        :options="infoWindowOptions"
                                        :position="infoWindowPosition"
                                        :opened="infoWindowOpened"
                                        @closeclick="HandleCloseWindow"
                                    >
                                        <div class="info-window">
                                           <h5> Name: <span v-text="Name=currentLocation.first_name"> </span></h5>
                                            <h5> Gender:<span v-text="Gender=currentLocation.gender"></span></h5>
                                            <h5> Latitude:<span v-text="Gender=currentLocation.lat"></span></h5>
                                            <h5> Longitude: <span v-text="Gender=currentLocation.lon"></span></h5>
                                        </div>
                                    </gmap-info-window>
                                   <gmap-marker
                                        v-for="item in renderlocations"
                                        :key="item.id"
                                        :position="getPosition(item)"
                                        :icon= "handleGender(item)" 
                                        :clickable="true"
                                        :draggable="false"
                                        @click="handleCurrentLocation(item)"
                                    ></gmap-marker>
                              </gmap-map>
                           </div> 
                          <div class="column">
                               <div class="box">
                                 <div class="columns is-gapless">
                                     
                                     <div class="column">
                                          <button class="button is-success" @click="all">All</button>
                                     </div>
                                     <div class="column">
                                           <button class="button is-danger" @click="femaleGender">Display Females</button>
                                     </div>
                                     <div class="column">
                                          <button class="button is-info" @click="maleGender">Display Male</button>
                                     </div>
                                    <div class="column">
                                         <input class="input is-rounded"  type="text" placeholder=" Fname/Lname" :value="name" class="form-control" @keyup.enter="doSearch"> 
                                     </div>
                                     
                                 </div>
                              </div>
                              
                               <table class="table box is-striped">
                                  <thead>
                                    <tr>
                                      <th>S.No</th>
                                      <th>FName</th>
                                      <th>LName</th>
                                      <th>Gender</th>
                                      <th>Lat</th>
                                      <th>Long</th>
                                    </tr>
                                  </thead>
                                   <tbody>
                                        <tr v-for="item in renderlocations"  :key="item.id">
                                            <td v-text="item.id"></td>
                                            <td v-text="item.first_name"></td>
                                            <td v-text="item.last_name"></td>
                                            <td v-text="item.gender"></td>
                                            <td v-text="item.lat"></td>
                                            <td v-text="item.lon"></td>
                                           
                                        </tr>
                                   </tbody>
                              </table>
                           </div>     
                       </div>  
                     </div><!--container-->
                  </div><!--vue block app-->                
            </div><!--/Content-->
        </div><!--/Flex box-->

         <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
