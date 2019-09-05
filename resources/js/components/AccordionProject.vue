<template>
    <div>
        <accordion-item
        v-for="(body, title, index) in items"
        :title="title"
        :body="body"
        :key="index"
        :isopen="activeItemIndex==index"
        @toggled="onToggle"
        ></accordion-item>
    </div>


</template>

<script>
import AccordionItem from './AccordionItem.vue';
export default {
    props: ['items'],
    data() {
        return {
            activeItemIndex: null
        };
    },

    components: {AccordionItem},

    methods: {
        onToggle(index) {
            // listen event toggled (@toggled) và nhận index từ component child
            if (this.activeItemIndex == index) {
                return (this.activeItemIndex = null);
            };
            this.activeItemIndex = index;
        }
    }
//<accordion-item> là component con của <accordion-project>
// lưu ý cách viết import và component {}
// lưu ý cách bind dữ liệu từ file blade qua component parent rồi qua component child cách dùng : (v-bind) và viết các props
// dùng key là index trong object để send index từ component child qua component parent
// dùng key là index để tác động vào từng item con theo ý muốn (vd: khi có project mới được mở các project khác sẽ đóng)
// key không nhất thiết phải là index có thể dùng id (:key=id) tùy trường hợp


    
}
</script>