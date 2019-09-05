<template>
    <div>
        <div class="flex ml-10 mb-8">
            <div class="mr-4">
                <div 
                @click="toggle">
                    <svg v-if="isopen" class="fill-current text-alert w-5 h-5 leading-none cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83 2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z"/></svg>
                    <svg v-else class="fill-current text-default w-5 h-5 leading-none cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/></svg>
                </div>
            </div>
            <div class="leading-loose">
                <h3 v-text="title"
                class="font-bold text-2xl mb-3 text-default leading-none cursor-pointer capitalize"
                @click="toggle"
                ></h3>
                <div v-html="body" v-show="isopen"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['title', 'body', 'isopen'],
    methods: {
        toggle() {
            this.$emit('toggled', this.$vnode.key);
            // gửi event toggled cùng với this.$vnode.key là index qua component parent
            //component parent sẽ listen event để chạy func có dùng giá trị index này
        }
    }
}
// cách viết v-if v-else như if else
</script>