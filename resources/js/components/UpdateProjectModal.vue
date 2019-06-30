<template>
    <modal name="edit-project" classes="p-10 bg-card rounded-lg" height="auto">
        <h1 class="font-normal mb-10 text-center text-2xl">Let’s Start Something Change</h1>

        <form @submit.prevent="submit">
                
                <div class="flex-1">
                    <div class="mb-4">
                        <label for="title" class="text-sm block mb-2">Title</label>
                        <input
                            type="text"
                            id="title"
                            class="border p-2 text-xs block w-full rounded"
                            :class="form.errors.title ? 'border-alert':'border-muted-light'"
                        
                            v-model="form.title">

                        <span class="text-xs text-alert italic" v-if="form.errors.title" v-text="form.errors.title[0]"></span>
                    </div>

                    <div class="mb-4">
                        <label for="body" class="text-sm block mb-2">Description</label>

                        <textarea
                            id="body"
                            class="border border-muted-light p-2 text-xs block w-full rounded"
                            :class="form.errors.body ? 'border-alert':'border-muted-light'"
                            rows="7"
                           
                            v-model="form.body"
                        ></textarea>
                        <span class="text-xs text-alert italic" v-if="form.errors.body" v-text="form.errors.body[0]"></span>
                    </div>
                </div>
          

            <footer class="flex justify-end">
                <button type="button" class="button is-outlined mr-4" @click="$modal.hide('edit-project')">Cancel</button>
                <button class="button">Update Project</button>
            </footer>
        </form>
    </modal>
</template>

<script>
import BirdboardForm from './BirdboardForm';
export default {
    props: ['id', 'oldtitle', 'oldbody'],
    data () {
    //Các giá trị trên template phải được khai ở data()
    //Các attribute bên BirdboardForm được khai ở file này nên có thể tùy biến
        return {
            form: new BirdboardForm ({
                title: this.oldtitle,
                body: this.oldbody
            })
        };
    },

    methods: {
       async submit() {
        
           this.form.patch('/projects/'+this.id)
           .then(response=>location = response.data.message);
            
        }
    }
}
</script>

