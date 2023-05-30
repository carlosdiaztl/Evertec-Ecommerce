<template>
    <div class="text-center">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4" v-for="item in items" :key="item.id">

                <div class="card w-100 h-100">
                    <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                        data-mdb-ripple-color="light">
                        <img class="w-100" :src="getImage(item.image)" />
                        <a href="{{ route('product.show', $product) }}">
                            <div class="mask">
                                <div class="d-flex justify-content-start align-items-end h-100">
                                    <h5><span class="badge bg-dark ms-2">NEW</span></h5>
                                </div>
                            </div>
                            <div class="hover-overlay">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                </div>
                            </div>
                            {{ item.title }}
                        </a>
                    </div>
                    <div class="card-body">
                        <span class="text-reset">
                            <h5 class="card-title mb-2">{{ item.title }} </h5>
                        </span>
                       


                    </div>
                    <div class="card-footer p-0 bg-white border-0  ">
                        <h6 class="mb-3 price">{{ item.price }}$</h6>

                    </div>
                </div>


            </div>
        </div>
       
     <nav class="d-flex justify-items-center justify-content-center">

         <ul class="pagination center">
            <li class="page-item">
                <span class="page-link" :class="hasPrevPage ? 'active' : ''" @click="hasPrevPage?fetchPage(prevPageUrl):null">Anterior</span>
              </li>
              <li class="page-item active" >

                  <span class="page-link">{{currentPage  }} </span>
              </li>
           <li class="page-item">
   <span class="page-link" :class="hasNextPage?'active':''"  @click="hasNextPage ? fetchPage(nextPageUrl) : null">Siguiente</span>
               
           </li>
         </ul>
     </nav>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        items: [],
        currentPage: 1,
        prevPageUrl: '',
        nextPageUrl: '',
        hasPrevPage: false,
        hasNextPage: false
      };
    },
    mounted() {
      this.fetchPage(window.location.href.substring(0, window.location.href.indexOf('public/') + 7)+'api/products');
    },
    methods: {
      fetchPage(url) {
        axios.get(url)
          .then(response => {
            this.items = response.data.data;
            this.currentPage = response.data.current_page;
            this.prevPageUrl = response.data.prev_page_url;
            this.nextPageUrl = response.data.next_page_url;
            this.hasPrevPage = !!response.data.prev_page_url;
            this.hasNextPage = !!response.data.next_page_url;
            console.log(response.data);
          })
          .catch(error => {
            console.error(error);
          });
      },
      getImage(rutaProducto) {
    const baseUrl = window.location.href.substring(0, window.location.href.indexOf('public/') + 7);
    return baseUrl + rutaProducto;
  }
    }
  };
  </script>