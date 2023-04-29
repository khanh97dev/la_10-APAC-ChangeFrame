<q-layout view="lHh Lpr lFf" class="bg-white">
    <q-header elevated>
        <q-toolbar>
            <q-btn flat dense round @click="toggleLeftDrawer" aria-label="Menu" icon="menu" />

            <q-toolbar-title>
                Quasar App
            </q-toolbar-title>
        </q-toolbar>
    </q-header>

    <q-drawer v-model="leftDrawerOpen" show-if-above bordered class="bg-grey-2">
        <q-list>
            <q-item-label header>Essential Links</q-item-label>
            <q-item clickable target="_blank" rel="noopener" href="https://quasar.dev">
                <q-item-section avatar>
                    <q-icon name="school" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Docs</q-item-label>
                    <q-item-label caption>https://quasar.dev</q-item-label>
                </q-item-section>
            </q-item>
            <q-item clickable target="_blank" rel="noopener" href="https://github.quasar.dev">
                <q-item-section avatar>
                    <q-icon name="code" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>GitHub</q-item-label>
                    <q-item-label caption>github.com/quasarframework</q-item-label>
                </q-item-section>
            </q-item>
            <q-item clickable target="_blank" rel="noopener" href="http://chat.quasar.dev">
                <q-item-section avatar>
                    <q-icon name="chat" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Discord Chat Channel</q-item-label>
                    <q-item-label caption>https://chat.quasar.dev</q-item-label>
                </q-item-section>
            </q-item>
            <q-item clickable target="_blank" rel="noopener" href="https://forum.quasar.dev">
                <q-item-section avatar>
                    <q-icon name="record_voice_over" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Forum</q-item-label>
                    <q-item-label caption>https://forum.quasar.dev</q-item-label>
                </q-item-section>
            </q-item>
            <q-item clickable target="_blank" rel="noopener" href="https://twitter.quasar.dev">
                <q-item-section avatar>
                    <q-icon name="rss_feed" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Twitter</q-item-label>
                    <q-item-label caption>@quasarframework</q-item-label>
                </q-item-section>
            </q-item>
            <q-item clickable target="_blank" rel="noopener" href="https://facebook.quasar.dev">
                <q-item-section avatar>
                    <q-icon name="public" />
                </q-item-section>
                <q-item-section>
                    <q-item-label>Facebook</q-item-label>
                    <q-item-label caption>@QuasarFramework</q-item-label>
                </q-item-section>
            </q-item>
        </q-list>
    </q-drawer>

    <q-page-container>
        <router-view />
    </q-page-container>
</q-layout>
