<template>
<div v-if="isLoaded">
  <header class="site-header">
    <div>
      <div class="sm:span-4">
        <a href="/">
          <icon-logo />
        </a>
        <div class="site-header__title sm:hide">
          <h1>Dashboard</h1>
        </div>
      </div>
      <div class="sm:span-8">
        <nav class="site-menu-dashboard js-menu">
          <div>
            <div class="site-menu__items">
              <ul>
                <li>
                  <router-link :to="{name: 'courses'}" :class="[isActive ? 'is-active' : '', '']">
                    Kurse
                  </router-link>
                </li>
                <li>
                  <router-link :to="{name: 'experts'}">
                    Experten
                  </router-link>
                </li>
                <li>
                  <router-link :to="{name: 'students'}">
                    Studenten
                  </router-link>
                </li>
              </ul>
              <ul>
                <li>
                  <router-link :to="{name: 'admin-profile'}" class="icon-profile">
                    <icon-profile class="is-active" />
                  </router-link>
                </li>
                <li>
                  <a href="javascript:;" @click="toggleMenu()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 20" width="24" height="20">
                      <path fill="currentColor" d="M2 1.9h20v2H2v-2zm0 7h20v2H2v-2zm0 7h20v2H2v-2z"/>
                    </svg>
                  </a>
                </li>
              </ul>
            </div>
            <div :class="[hasMenu ? 'is-open' : '', 'site-menu__overflow-items']">
              <ul>
                <li>
                  <a href="javascript:;" class="btn-menu-toggle" @click="toggleMenu()">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 20 20">
                      <path fill="currentColor" d="M17.6 1L10 8.6 2.4 1 1 2.4 8.6 10 1 17.6 2.3 19l7.6-7.7 7.7 7.7 1.4-1.4-7.7-7.7 7.6-7.6z"/>
                    </svg>
                  </a>
                </li>
                <li>
                  <a href="">Backoffice</a>
                </li>
                <li>
                  <router-link :to="{name: 'discount-codes'}">
                    Rabatt-Codes
                  </router-link>
                </li>
                <li class="is-parent">
                  <a href="" @click.prevent="toggleSubMenu('content')" :class="[hasSubMenu.content || $route.name.startsWith('content')  ? 'is-active' : '', '']">
                    Seiteninhalte
                  </a>
                  <ul v-if="hasSubMenu.content || $route.name.startsWith('content') ">
                    <li>
                      <router-link :to="{name: 'content-home-layout'}" :class="[$route.name.startsWith('content-home') ? 'is-active' : '', '']">
                        Startseite
                      </router-link>
                    </li>
                    <li>
                      <router-link :to="{name: 'content-heroes'}" :class="[$route.name.startsWith('content-hero') ? 'is-active' : '', '']">
                        Heroes
                      </router-link>
                    </li>
                    <li>
                      <router-link :to="{name: 'content-team-members'}" :class="[$route.name.startsWith('content-team-') ? 'is-active' : '', '']">
                        Team
                      </router-link>
                    </li>
                    <li>
                      <router-link :to="{name: 'content-news'}" :class="[$route.name.startsWith('content-news') ? 'is-active' : '', '']">
                        News
                      </router-link>
                    </li>
                  </ul>
                </li>
                <li>
                  <router-link :to="{name: 'settings'}">
                    Einstellungen
                  </router-link>
                </li>
                <li>
                  <router-link :to="{name: 'admin-profile'}">
                    Mein Profil
                  </router-link>
                </li>
                <li>
                  <a href="/logout" class="logout">Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
       </div>
    </div>
  </header>
  <router-view></router-view>
</div>
</template>
<script>
import NProgress from 'nprogress';
import IconLogo from "@/shared/components/ui/icons/Logo.vue";
import IconProfile from "@/shared/components/ui/icons/Profile.vue";

export default {

  components: {
    NProgress,
    IconLogo,
    IconProfile,
  },

  data() {
    return {
      isLoaded: true,
      isActive: false,
      hasMenu: false,
      hasSubMenu: {
        content: false,
      }
    }
  },

  methods: {
    toggleMenu() {
      this.hasMenu = this.hasMenu ? false : true;
    },

    toggleSubMenu(type) {
      this.hasSubMenu[type] =  this.hasSubMenu[type] ? false : true
    },

    showMenu() {
      this.hasMenu = true;
    },

    hideMenu() {
      this.hasMenu = false;
    },

    hideSubMenu() {
      this.hasSubMenu.content = false;
    },
  },
  watch: {
    '$route'() {
      this.hideMenu();
      this.hideSubMenu();
    }
  },
}
</script>