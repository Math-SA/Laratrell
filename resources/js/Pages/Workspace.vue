<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TaskList from '@/Components/TaskList.vue';
import Inertia from '@inertiajs/inertia-vue3';
import { ref, provide } from 'vue';
import TaskListCreate from '@/Components/TaskListCreate.vue';
import DeleteItemArea from '@/Components/DeleteItemArea.vue';

import WorkspaceSelector from '@/Components/WorkspaceSelector.vue';


const props = defineProps({
        workspaces:{type:Array, default:[]}, 
        selectedWorkspace: {type:Object, default:null},
        taskLists: {type: Array, default: []}
});

const creatingTaskList = ref(false);
provide('creatingTaskList', creatingTaskList);
const dragging = ref(false);
provide('dragging', dragging);
const draggingList = ref(false);
provide('draggingList', dragging);

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
            <div class="w-28 flex bg-white" :class="{hidden: !dragging}">
                <DeleteItemArea></DeleteItemArea>
            </div>
            <TaskList v-if="props.selectedWorkspace" v-for="taskList in props.selectedWorkspace.task_lists" :taskList="taskList"></TaskList>
        </div>
        
       
    </AppLayout>
</template>