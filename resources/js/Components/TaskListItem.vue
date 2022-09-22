<script setup>
import { Inertia } from '@inertiajs/inertia';
import { inject, ref} from 'vue';

const targetPosition = inject('targetPosition');

const props = defineProps({
    task: 
        {type:Object, 
            default:null},
   
  });

const dragging = inject('dragging');

const drag = ev => {
    dragging.value = true;
    ev.dataTransfer.setData('laratrell/taskItemId', ev.target.dataset.value);
};

const drop = event=>{
    event.preventDefault();
    targetPosition.value = props.task.order;
};
const dragEnd = ev =>{
    dragging.value = false;
}

</script>

<template>
    <div class="bg-white hover:backdrop-blur-sm max-w-sm rounded overflow-hidden shadow-lg px-6 py-4" draggable="true" @dragstart="drag" :data-value="JSON.stringify({'task':{'id':task.id, 'currentListId':task.task_list_id}})" @dragover.prevent @drop.prevent="drop" @dragend.prevent="dragEnd" @dragcancel.prevent="dragEnd">
        <div class="font-bold text-xl mb-2">{{task.name}}</div>
        <span v-if="task.projectName" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 float-right">{{task.projectName}}</span>
        <div class="px-6 pt-4 pb-2">{{task.description}}</div>
    </div>
</template>