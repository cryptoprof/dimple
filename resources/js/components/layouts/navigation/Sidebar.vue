<template>
    <!-- sidenav  -->
    <aside
        class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
        <div class="h-19.5">
            <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden"
               sidenav-close></i>
            <div class="logo py-2.7 text-sm ease-nav-brand my-0 mx-4">
                <h4>
                    <router-link :to="{name:'dashboard'}" class="nav-link">Dimple <strong>Simple</strong>
                    </router-link>
                </h4>
            </div>
        </div>

        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent"/>
        <nav id="sidebar" class="sidebar">
            <ul id="side-nav" class="side-nav nav-collapse ">
                <router-link :to="{name:'dashboard'}"
                             exact
                             class="nav-link py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                             active-class="rounded-lg shadow-soft-xl  bg-white  font-semibold text-slate-700">
                    <i class="fa fa-home pr-2"></i> {{$t('dashboard')}}
                </router-link>

                <router-link :to="{name:'users'}"
                             v-if="user.user.UserRoles.includes('admin')"
                             exact
                             class="nav-link py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                             active-class="rounded-lg shadow-soft-xl  bg-white  font-semibold text-slate-700">
                    <i class="fa fa-users pr-2"></i> {{$t('users')}}
                </router-link>
                <router-link :to="{name:'customers'}"
                             exact
                             class="nav-link py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                             active-class="rounded-lg shadow-soft-xl  bg-white  font-semibold text-slate-700">
                    <i class="fa fa-user-plus pr-2"></i> {{$t('clients')}}
                </router-link>
                <router-link :to="{name:'ManageTasks'}"
                             v-if="user.user.UserRoles.includes('admin')"
                             exact
                             class="nav-link py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                             active-class="rounded-lg shadow-soft-xl  bg-white  font-semibold text-slate-700">
                    <i class="fa fa-table pr-2"></i> {{$t('tasks_manage')}}
                </router-link>
                <router-link :to="{name:'myTasks'}"
                             exact
                             class="nav-link py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                             active-class="rounded-lg shadow-soft-xl  bg-white  font-semibold text-slate-700">
                    <i class="fa fa-table pr-2"></i> {{ $t('my_tasks') }}
                </router-link>
                <router-link :to="{name:'projects'}"
                             exact
                             class="nav-link py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                             active-class="rounded-lg shadow-soft-xl  bg-white  font-semibold text-slate-700">
                    <i class="fa fa-cogs pr-2"></i> {{ $t('projects') }}
                </router-link>

            </ul>


        </nav>


        <div class="mx-4 mt-4">
            <!-- load phantom colors for card after: -->
            <p class="invisible hidden text-gray-800 text-red-500 text-red-600 after:bg-gradient-to-tl after:from-gray-900 after:to-slate-800 after:from-blue-600 after:to-cyan-400 after:from-red-500 after:to-yellow-400 after:from-green-600 after:to-lime-400 after:from-red-600 after:to-rose-400 after:from-slate-600 after:to-slate-300 text-lime-500 text-cyan-500 text-slate-400 text-fuchsia-500"></p>
            <div
                class="after:opacity-65 after:bg-gradient-to-tl after:from-slate-600 after:to-slate-300 relative flex min-w-0 flex-col items-center break-words rounded-2xl border-0 border-solid border-blue-900 bg-white bg-clip-border shadow-none after:absolute after:top-0 after:bottom-0 after:left-0 after:z-10 after:block after:h-full after:w-full after:rounded-2xl after:content-['']"
                sidenav-card>
                <div class="mb-7.5 absolute h-full w-full rounded-2xl bg-cover bg-center"
                     style="background-image: url('./assets/img/curved-images/white-curved.jpeg')"></div>
                <div class="relative z-20 flex-auto w-full p-4 text-left text-white">
                    <div
                        class="flex items-center justify-center w-8 h-8 mb-4 text-center bg-white bg-center rounded-lg icon shadow-soft-2xl">
                        <i class="top-0 z-10 text-transparent ni leading-none ni-diamond text-lg bg-gradient-to-tl from-slate-600 to-slate-300 bg-clip-text opacity-80"
                           sidenav-card-icon></i>
                    </div>
                    <div class="transition-all duration-200 ease-nav-brand">
                        <h6 class="mb-0 text-white">{{ $t('q_need_help') }}</h6>
                        <p class="mt-0 mb-4 font-semibold leading-tight text-xs">{{ $t('look_documentation')}}</p>
                        <a href="https://github.com/cryptoprof/dimple"
                           target="_blank"
                           class="inline-block w-full px-8 py-2 mb-0 font-bold text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102">{{ $t('documentation') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</template>

<script>
export default {
    name: "Sidebar",
    props: ['user']
}
</script>

<style scoped>

</style>
