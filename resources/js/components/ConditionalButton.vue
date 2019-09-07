<template>
    <div v-show="isActive" 
    @click="$modal.show('new-project')"
    class="fixed pin-b pin-r z-10 ">
        
        <svg class="fill-current text-accent w-12 h-12 leading-none cursor-pointer items-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 9V5H9v4H5v2h4v4h2v-4h4V9h-4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20z"/></svg>
        
    </div>
</template>

<script>
import inViewport from 'in-viewport';
export default {
    data() {
        return {
            isActive: false
        };
    },

    mounted() {
        window.addEventListener('scroll', this.checkDisplay, {passive: true});
        //passive event listeners can great improve scrolling performance
    },

    methods: {
        checkDisplay() {
            this.isActive = !inViewport(document.getElementById('button1'));
        }
    }
}

// khi dùng position fixed cho 1 đối tượng phải đi kèm vị trí đê nó xuất hiện (vd pin-l, top...)
// nếu không có các giá trị về vị trí đối tượng này không hiển thị
// in-viewport là 1 package để xác định 1 đối tượng có hiển thị trên màn hình hay không khi ta scrolling
// in-viewport có thể trả về boolean tương ứng với đối tượng đó có đang show trên màn hình(viewport)?
// từ đó ta viết func để đối tượng này xuất hiện khi đối tượng kia mất đi
// hoặc func chỉ chạy khi scroll đến đối tượng đó
</script>