<template>
   <div @mouseover="active=true" @mouseout="active=false">
        <h2 
        class="text-muted text-base font-light mb-3 py-4 px-2 hover:text-alert hover:font-bold"
        :class="active? 'text-alert font-bold':''"
        >My Info</h2>
        <portal to="info-list">
            <div v-show="active"
                @mouseover="active=true" @mouseout="active=false"
                class=" flex w-full py-4 -ml-5 pl-4 mb-6 bg-card absolute z-10" style="height:150px">
                    <div class="w-1/4"></div>
                    <div class="w-1/4">
                        <ul class="list-reset font-serif font-bold text-muted text-lg">
                            <li class="px-2 py-2">Name: {{this.info.name}}</li>
                            <li class="px-2 py-2">Email: {{this.info.email}}</li>
                            <li class="px-2 py-2">Role: {{this.info.role}}</li>
                        </ul>
                    </div>
                    <div class="w-1/4">
                        <ul class="list-reset font-serif font-bold text-muted text-lg">
                            <li class="px-2 py-2">Joined at: {{this.info.created_at}}</li>
                            <li class="px-2 py-2">Your own project: {{this.value2}}</li>
                            <li class="px-2 py-2">Your shared project: {{this.value3}}</li>
                        </ul>
                    </div>
                    <div class="w-1/4"></div>
            </div>
            
        </portal>
        
   </div>
   
</template>

<script>
    export default {
       props: ["value1", "value2", 'value3'],
        data() {
            return { 
                active: false,
             
                info: this.value1
                };
        },
        computed: {
            
        },

        methods: {
            
        }


       
     
           
    }
</script>