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
                <!-- <li style="position: relative">
                  <a href="" class="btn-more">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="24" width="24" stroke-width="1.5" stroke="#000" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                  </a>
                  <div>
                    <ul>
                      <li>
                        <a href="">Einstellungen</a>
                      </li>
                      <li>
                        <a href="">Backoffice</a>
                      </li>
                      <li>
                        <a href="">Newsletter</a>
                      </li>
                    </ul>
                  </div>
                </li> -->
              </ul>
              <ul>
                <li>
                  <router-link :to="{name: 'admin-profile'}">
                    <icon-profile />
                  </router-link>
                </li>
               <li>
                  <a href="/logout">Logout</a>
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
      isLoaded: false,
      isActive: false,
    }
  },

  mounted() {
    this.fetchUser();
  },

  methods: {
    fetchUser() {
      if (!this.$store.state.user) {
        this.isLoaded = false;
        this.axios.get(`/api/user`).then(response => {
          this.$store.commit('user', response.data);
          this.isLoaded = true;
        });
      }
    },
  },
  watch: {
    '$route'() {

    }
  },
}
</script>
<style>
.btn-more {
  align-items: center;
  display: flex;
  justify-content: center;
  height: 36px;
  position: relative;
  transform: translateY(-6px);
  width: 44px;
  z-index: 201;
}
.btn-more:before {
  border-bottom: 1px solid #fff;
  content: '';
  display: block;
  height: 36px;
  left: 0;
  position: absolute;
  top: 0;
  width: 44px;
}
.btn-more svg {
  display: block;
}
.btn-more + div {
  background: white;
  border: 1px solid #222;
  display: none;
  right: 0;
  padding: 16px;
  position: absolute;
  top: 29px;
  z-index: 101;
}
.btn-more + div li,
.btn-more + div li a {
  justify-content: flex-end;
  margin: 0 !important;
}

li:hover .btn-more:before {
  border: 1px solid #222;
}
li:hover .btn-more + div {
  /*box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;*/
  display: block;
}

.btn-more + div > ul {
  flex-direction: column;
}
</style>