<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TaskList from '@/Components/TaskList.vue';
import Inertia from '@inertiajs/inertia-vue3';
import { ref, provide } from 'vue';
import TaskListCreate from '@/Components/TaskListCreate.vue';

import WorkspaceSelector from '@/Components/WorkspaceSelector.vue';


const props = defineProps({
        workspaces:{type:Array, default:[]}, 
        selectedWorkspace: {type:Object, default:null},
        taskLists: {type:Array, default:null}
});


const creatingTaskList = ref(false);
provide('creatingTaskList', creatingTaskList);

</script>

<template>
    <AppLayout title="Workspace">
        <template #header>
            <div class="w-1/4 flex justify-between">
                <WorkspaceSelector :workspaces="workspaces" :selectedWorkspace="selectedWorkspace"></WorkspaceSelector>
                <button v-if="selectedWorkspace" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded"
                    @click.native="creatingTaskList = true">
                    Add Task List
                </button>
                <TaskListCreate v-if="selectedWorkspace" :workspaceId="props.selectedWorkspace.id"></TaskListCreate>
            </div>
            
        </template>
        <div class="px-2 py-2 w-full flex flew-row gap-x-8 bg-[#6875F5]">
            <TaskList v-for="taskList in $page.props.taskLists" :taskList="taskList"></TaskList>
        </div>
       
    </AppLayout>
</template>