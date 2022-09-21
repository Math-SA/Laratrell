<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import WorkspaceCreate from '@/Components/WorkspaceCreate.vue';
import { Inertia } from '@inertiajs/inertia';
import { ref, provide } from 'vue';


    const props = defineProps({workspaces:{type:Array, default:[]}, 
            selectedWorkspace: {type:Object, default:null}});
    const switchWorkspace = (workspace) => {
        Inertia.put(route('workspace-select.update'), {
            //data
            workspace_id: workspace.id,
        }, {
            //other options
            preserveState: false,
            preserveScroll: false,
            onSuccess: ()=>{
                Inertia.reload();
            }
        });
        
    };

    const creating = ref (false);
    provide('creating', creating)

    const create = ()=>{
        creating.value = true;
    }


</script>
<template>

<Dropdown align="left" width="60">
    <template #trigger>
        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
             <span v-if="selectedWorkspace" class="inline-flex rounded-md">{{ selectedWorkspace.name }} 
            </span>
            <span v-else>Select a workspace </span>
            <svg
            class="ml-2 -mr-0.5 h-4 w-4"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            fill="currentColor"
            >
                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </template>   
    <template #content>
        <div class="w-60">
                <div class="block px-4 py-2 text-xs text-gray-400">
                    Available workspaces
                </div>

                <template v-for="workspace in workspaces" :key="workspace.id">
                    <form @submit.prevent="switchWorkspace(workspace)">
                        <DropdownLink as="button">
                            <div class="flex items-center">
                                <div>{{ workspace.name }}</div>
                            </div>
                        </DropdownLink>
                    </form>
                </template>
                <form @submit.prevent="create()">
                        <DropdownLink as="button">
                            <div class="flex items-center">
                                <div>Create a new workspace</div>
                            </div>
                        </DropdownLink>
                </form>
                <WorkspaceCreate></WorkspaceCreate>
        </div>
    </template>
</Dropdown>
</template>