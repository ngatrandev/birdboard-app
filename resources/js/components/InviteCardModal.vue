<template>
    <modal name="invite-card" classes="p-10 bg-card rounded-lg" height="auto" @before-close="reset">
        <h1 class="font-normal mb-5 text-center text-2xl">Add your friend</h1>

        <form @submit.prevent="submit">
                
                <div 
                    :class="errors.email ? 'border-alert':'border-muted'"
                    class="flex mb-4 border p-1 text-xs rounded">
                        <svg class="h-4 w-4 fill-current text-accent mr-2 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/></svg>
                        <input
                            type="email"
                            placeholder="Email address"
                            class="p-1 :focus outline-none" 
                            @input="testEmail($event.target.value)"
                            v-model="form.email"
                            >
                        <span v-if="form.validEmail">
                            <svg class="h-3 w-3 fill-current text-accent mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                        </span> 
                        <span v-if="form.usedEmail" >
                            <svg class="h-4 w-4 fill-current text-alert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zM11.4 10l2.83-2.83-1.41-1.41L10 8.59 7.17 5.76 5.76 7.17 8.59 10l-2.83 2.83 1.41 1.41L10 11.41l2.83 2.83 1.41-1.41L11.41 10z"/></svg>
                        </span>
                        <p v-if="form.usedEmail" class="text-alert text-xs ml-2 mt-1">This email joined your project.</p>     
                </div>
                <div class="mb-4">
                    <span class="text-xs text-alert italic" v-if="errors.email" v-text="errors.email[0]"></span>
                </div>
            <footer class="flex justify-end">
                <button type="button" class="button is-outlined mr-4" @click="$modal.hide('invite-card')">Cancel</button>
                <button class="button" :class="form.usedEmail? 'line-through text-muted bg-white' : ''" :disabled="form.usedEmail" >Invite friend</button>
            </footer>
        </form>
    </modal>
</template>

<script>

export default {
    props: ['id', 'allemail', 'invalidemail'],
    data () {
    //Các giá trị trên template phải được khai ở data()
        return {
            form: {
                email: '',
                validEmail: false,
                usedEmail: false,
                },
            errors: {}
        };
    },

    methods: {
            testEmail(code) {
             
                this.errors = {};//để khi thay đổi input data (khi typing) các errors sẽ bị xóa
                if (this.invalidemail.includes(code)) {
                   
                    this.form.usedEmail = true;
                    
                } else {
                    if (this.allemail.includes(code)) {
                    this.form.validEmail = true; 
                   
                    } else {
                         this.form.usedEmail = false;
                         this.form.validEmail = false;
                         
                    }
                }
                
            },

            reset() {
                this.errors = {};
                this.form.usedEmail = false;
                this.form.validEmail = false;
                this.form.email = '';
            // dùng @before-close event để trả về mặc định trước khi close form
            },

    async submit() {
           try {
                location = (await axios.post('/projects/'+this.id+'/invitations', this.form)).data.message;
           } catch (error) {
               this.errors = error.response.data.errors;
           }
            
        }
    }
}
// các svg icon thêm vào có thể tùy chỉnh qua class có thể bind với điều kiện để khi nào xuất hiện icon
// dùng :disable của button để kiểm tra nếu email đã dùng thì button bị disable không thể submit nên không cần viết error
</script>