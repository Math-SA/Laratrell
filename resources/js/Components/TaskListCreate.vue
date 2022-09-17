<script setup>
    import { ref, inject } from 'vue';
    import { Head, useForm } from '@inertiajs/inertia-vue3';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import ConfirmationModal from '@/Components/ConfirmationModal.vue';
    

    const props = defineProps({
        workspaceId: {type:Number, default:null}
        });

    const form = useForm({
        name: '',
        workspaceId: props.workspaceId,
    });

    const creating = inject('creatingTaskList');

    const submit = () => {
        form.post(route('task_list.create'), {
            onFinish: () => {
                form.reset();
                form.name = '';
                creating.value = false;

            },
        });
    };

</script>
<template>
    <ConfirmationModal :show="creating" @close="creating = false">
        <template #title>
            Create new task list
        </template>

        <template #content>
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Task list name" />
                    <TextInput
                        id="name"
                        ref="TasklistName"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                    />
                </div>
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create
                    </PrimaryButton>
                    <SecondaryButton @click.native="creating = false">
                        Nevermind
                    </SecondaryButton>  
            </form>
        </template>
    </ConfirmationModal>
</template>