/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('tile-spinner', require('./components/TileSpinner.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 * 
 */
import * as VueGoogleMaps from 'vue2-google-maps';

Vue.use(VueGoogleMaps, {
    load: {
        key: ''
    }
});
const app = new Vue({
    el: '#app',

    data:{
    	 name:'',
    	 femaleIcon:'http://maps.gstatic.com/mapfiles/ridefinder-images/mm_20_purple.png',
    	 maleIcon:'http://maps.gstatic.com/mapfiles/ridefinder-images/mm_20_blue.png',
    	 renderlocations:[],
    	 locations:[],       
       infoWindowOptions:{
               pixelOffset:{
               	 width:0,
               	 height:-40
               }
       },
      currentLocation:{},
      infoWindowOpened:false

    },
   
   created() {
        axios.get('/api/locations')
            .then((response) => {
               this.locations = response.data;
               this.renderlocations = response.data;

             })
            .catch((error) => console.error(error));
    },
    methods:{

       getPosition(item) {
            return {
                lat: parseFloat(item.lat),
                lng: parseFloat(item.lon)
            }
        },
        handleCurrentLocation(item) {
            this.currentLocation = item;
            this.infoWindowOpened = true;
        },
        HandleCloseWindow() {
            this.currentLocation = {};
            this.infoWindowOpened = false;
        },
        handleGender(item){
          if(item.gender == "Male")
            return this.maleIcon;
          else
            return this.femaleIcon;
         },

      	femaleGender(){
      		let females = this.locations.filter(location =>  location.gender =="Female");
      		return this.renderlocations = females;
      		console.log(this.locations);//for testing purpose
      	},
      	maleGender(){
      		let males = this.locations.filter(location =>  location.gender =="Male");    		
      		return this.renderlocations = males;
      		console.log(this.locations);//for testing purpose    		
      	},
      	all(){
      		return this.renderlocations = [...this.locations];
      	},
      	doSearch(event){
                         
  		     return this.renderlocations = this.locations.filter(location =>
  		             location.first_name.toLowerCase().includes(event.target.value.toLowerCase())
  		             ||  location.last_name.toLowerCase().includes(event.target.value.toLowerCase())
  		      )               
      	},
    },

    computed:{
   	 mapCenter() {
            if (!this.locations.length) {
                return {
                    lat: 10,
                    lng: 10
                }
            }

            return {
                lat: parseFloat(this.locations[0].lat),
                lng: parseFloat(this.locations[0].lon)
            }
        },
        infoWindowPosition() {
            return {
                lat: parseFloat(this.currentLocation.lat),
                lng: parseFloat(this.currentLocation.lon)
            };
        },

    }
   
});
