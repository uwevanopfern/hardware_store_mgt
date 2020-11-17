<template>
  <a-layout id="components-layout-demo-custom-trigger">
    <a-layout-sider v-model="collapsed" :trigger="null" collapsible>
      <div class="logo" />
      <a-menu theme="dark" mode="inline" :default-selected-keys="['1']">
        <a-menu-item key="1">
          <a-icon type="home" />
          <span>Dashboard</span>
        </a-menu-item>
        <a-sub-menu key="inventory">
          <span slot="title"><a-icon type="stock" /><span>Inventory</span></span>
          <a-menu-item key="3">
            Stock
          </a-menu-item>
          <a-menu-item key="4">
            Products
          </a-menu-item>
          <a-menu-item key="5">
            Clients
          </a-menu-item>
          <a-menu-item key="6">
            Journal
          </a-menu-item>
        </a-sub-menu>
        <a-sub-menu key="reports">
          <span slot="title"><a-icon type="project" /><span>Reports</span></span>
          <a-menu-item key="3">
            Stock
          </a-menu-item>
          <a-menu-item key="4">
            Products
          </a-menu-item>
          <a-menu-item key="5">
            Clients
          </a-menu-item>
          <a-menu-item key="6">
            Journal
          </a-menu-item>
        </a-sub-menu>
      </a-menu>
    </a-layout-sider>
    <a-layout>
      <a-layout-header style="background: #fff; padding: 0">
        <a-icon
          class="trigger"
          :type="collapsed ? 'menu-unfold' : 'menu-fold'"
          @click="() => (collapsed = !collapsed)"
        />
        <user-avatar/>
      </a-layout-header>
      <a-layout-content
        :style="{
          margin: '24px 16px',
          padding: '24px',
          background: '#fff',
          minHeight: '280px',
        }"
      >
        Dashboard
      </a-layout-content>
    </a-layout>
  </a-layout>
</template>
<script>
export default {
  data() {
    return {
      collapsed: false,
    };
  },
};
</script>
<style>
#components-layout-demo-custom-trigger {
  height: 100vh;
}
#components-layout-demo-custom-trigger .trigger {
  font-size: 18px;
  line-height: 64px;
  padding: 0 24px;
  cursor: pointer;
  transition: color 0.3s;
}

#components-layout-demo-custom-trigger .trigger:hover {
  color: #1890ff;
}

#components-layout-demo-custom-trigger .logo {
  height: 32px;
  background: rgba(255, 255, 255, 0.2);
  margin: 16px;
}
</style>