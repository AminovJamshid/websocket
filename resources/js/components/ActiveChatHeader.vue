<script setup>

</script>

<template>
    <div
        class="flex justify-between items-center border-b border-gray-100 dark:border-gray-800 p-4">
        <div class="flex">
            <img src="assets/images/client/01.jpg"
                 class="size-11 rounded-full shadow dark:shadow-gray-700" alt="">
            <div class="overflow-hidden ms-3">
                <a href="#" class="block font-semibold text-truncate">Cristino Murfy</a>
                <span class="text-slate-400 flex items-center text-sm"><span
                    class="bg-green-600 text-white text-[10px] font-bold rounded-full size-2 me-1"></span> Online</span>
            </div>
        </div>

        <div class="dropdown relative">
            <button data-dropdown-toggle="dropdown" class="dropdown-toggle items-center"
                    type="button">
                                            <span
                                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-[20px] text-center bg-green-600/5 hover:bg-green-600 border-green-600/10 hover:border-green-600 text-green-600 hover:text-white rounded-md"><i
                                                class="mdi mdi-dots-vertical"></i></span>
            </button>
            <!-- Dropdown menu -->
            <div
                class="dropdown-menu absolute end-0 m-0 mt-4 z-10 w-44 rounded-md overflow-hidden bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 hidden"
                onclick="event.stopPropagation();">
                <ul class="py-2 text-start">
                    <li>
                        <a href="" class="block py-1.5 px-4 hover:text-green-600"><i
                            class="mdi mdi-account-outline"></i> Profile</a>
                    </li>
                    <li>
                        <a href="" class="block py-1.5 px-4 hover:text-green-600"><i
                            class="mdi mdi-cog-outline"></i> Profile Settings</a>
                    </li>
                    <li>
                        <a href="" class="block py-1.5 px-4 hover:text-green-600"><i
                            class="mdi mdi-trash-can-outline"></i> Delete</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
