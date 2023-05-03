<template>
    <q-layout
        view="lHh Lpr lFf"
        class="bg-white"
    >
        <q-header elevated>
            <q-toolbar>
                <q-btn
                    flat
                    dense
                    round
                    @click="toggleLeftDrawer"
                    aria-label="Menu"
                    icon="menu"
                />
                <q-toolbar-title>
                    {{ props.appName }}
                </q-toolbar-title>
            </q-toolbar>
        </q-header>

        <q-drawer
            v-model="leftDrawerOpen"
            show-if-above
            bordered
            class="bg-grey-2"
        >
            <q-list>
                <q-item-label
                    header
                    v-text="props.menuHeader"
                ></q-item-label>
                <q-item
                    v-for="(item, index) in props.menu"
                    clickable
                    :active="item.active"
                    :target="item.target"
                    :href="item.href"
                    :key="index"
                >
                    <q-item-section avatar>
                        <q-icon :name="item.icon" gloss="AB" />
                    </q-item-section>
                    <q-item-section>
                        <q-item-label v-text="item.label" />
                        <q-item-label
                            caption
                            v-if="item.caption"
                            v-text="item.caption"
                        />
                    </q-item-section>
                </q-item>
            </q-list>
        </q-drawer>

        <q-page-container>
            <slot @emitPagination="emitPagination" />
        </q-page-container>
    </q-layout>
</template>

<script>
    import {
        inject,
        ref,
        watch
    } from 'vue'

    import {
        Cookies
    } from 'quasar'


    export default {
        name: 'MainLayout',

        props: {
            appName: {
                type: String,
            },
            menu: {
                type: Array
            },
            menuHeader: {
                type: String
            }
        },

        setup(props) {
            const leftDrawerOpen = ref(
                Cookies.get('leftDrawerOpen') === 'false' ? false : true
            )

            const toggleLeftDrawer = () => {
                leftDrawerOpen.value = !leftDrawerOpen.value
            }

            watch(leftDrawerOpen, (newV, oldV) => {
                Cookies.set('leftDrawerOpen', leftDrawerOpen.value)
            })

            return {
                toggleLeftDrawer,
                leftDrawerOpen,
                props
            }
        },
    }
</script>
