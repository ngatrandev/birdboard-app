<template>
   <div @mouseover="active=true" @mouseout="active=false">
        <h2 
        class="text-muted text-base font-light mb-3 py-4 px-2 hover:text-alert hover:font-bold"
        :class="active? 'text-alert font-bold':''"
        >My Project</h2>
        <portal to="project-list">
            <div v-show="active"
                @mouseover="active=true" @mouseout="active=false"
                class=" flex w-full py-4 -ml-5 pl-4 mb-6 bg-card absolute z-10" style="height:150px">
                    <div class="w-1/4 flex flex-wrap">
                        <div class="w-1/2"></div>
                        <div class="w-1/2">
                            <ul class="list-reset font-serif  text-sm text-default">
                                <li @mouseover="selectdata('group1')" 
                                class="py-2 px-2 hover:text-alert hover:font-bold"
                                :class="selected==='group1'? 'text-alert font-bold' : 'font-normal'"
                                >YOUR OWN PROJECT</li>
                                <li @mouseover="selectdata('group2')"
                                :class="selected==='group2'? 'text-alert font-bold' : 'font-normal'" 
                                class="py-2 px-2 hover:text-alert hover:font-bold"
                                >YOUR SHARED PROJECT</li>
                            </ul>
                        </div>
                    </div>
                    

                    <div class="w-3/4 border-l-2 border-muted-light">
                        <ul class="list-reset flex flex-wrap ml-10">
                            <li class="w-1/3 px-2 py-2"
                            v-for="(title, id) in showproject">
                                <a class="font-serif capitalize font-bold text-xs text-muted no-underline hover:text-default hover:font-bold" 
                                :href="'/projects/'+id" v-text="title"></a>
                            </li>
                        </ul>
                    </div>
            </div>
            
        </portal>
        
   </div>
   
</template>

<script>
    export default {
       props: ["value1", "value2"],
        data() {
            return { 
                active: false,
                selected: "group1",
                project: {
                    "group1": this.value1,
                    "group2": this.value2
                }
                };
        },
        computed: {
            showproject() {
                return this.project[this.selected];
            }
        },

        methods: {
            selectdata(name) {
                return this.selected=name;
                
            }
        }


       
     
           
    }
// class=" flex w-full absolute z-10..." style="height:150px"></div>
// thiếu w-full khi dùng position absolute gây lỗi (đã mất nhiều thời gian để fix lỗi này)
// z-index phải kết hợp với position: absolute, relative...
//position:relative của một phần tử liên quan đến vị trí hiện tại của nó mà không thay đổi bố cục xung quanh vị trí đó, 
//position:absolute của một phần tử liên quan đến vị trí của bố mẹ và thay đổi bố cục xung quanh vị trí đó.
// nếu data có dạng (key: value) thì khi dùng v-for="(value, key) in ..." giá trị đầu là value
// khi href có dùng data bên dưới thì phải viết :href để binding
</script>