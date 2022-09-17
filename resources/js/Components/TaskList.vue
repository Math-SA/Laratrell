<script setup>

import TaskListItem from '@/Components/TaskListItem.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TaskListItemCreate from '@/Components/TaskListItemCreate.vue';
import { Inertia } from '@inertiajs/inertia';
import { ref, provide, inject } from 'vue';




const props = defineProps({
    taskList: {
        type: Object,
        default: null
    }

  });


const targetPosition = ref(props.taskList.tasks.length);
const creatingTask = ref(false);
provide('creatingTask', creatingTask);

const myId = props.taskList.id;
const mySize = props.taskList.tasks.length;
provide('targetPosition', targetPosition);


const drop = event=>{
    event.preventDefault();
    var data = JSON.parse(event.dataTransfer.getData("laratrell/taskItemId"));
    if(data.task_list_id == myId){//if it's a reorder instad of moving between lists
        if (targetPosition.value == mySize) {//if the list is the target (ordering position hasn't been changed)
            targetPosition.value--;//set the end of the list as the target
        }
    }
    Inertia.put(
        route('task_list-move_item'), {
            taskListId: props.taskList.id,
            desiredOrder: targetPosition.value,
            listItem: data
        }, {
            preserveState: false,
            preserveScroll: false,
    });
    
};


const create = () =>{
    creatingTask.value = true;
}

</script>
<template>
    <div class="bg-white h-full w-96 rounded overflow-hidden shadow-xl px-6 py-4 space-y-1" @dragover.prevent @drop.prevent="drop">
        <div class="font-bold text-xl mb-2 flex justify-between">
            <span>{{taskList.name}}</span>
            <SecondaryButton @click.prevent="create">
                New Task
            </SecondaryButton> 
            <TaskListItemCreate :taskListId="myId"></TaskListItemCreate> 
        </div>
        
        
        <TaskListItem v-for="task in taskList.tasks" :task="task"></TaskListItem>
    </div>
</template>