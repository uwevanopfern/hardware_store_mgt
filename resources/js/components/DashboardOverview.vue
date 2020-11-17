<template>
  <div class="row">
    <div class="overview-cards">
      <div class="card-item">
        <div class="card-top"></div>
        <div class="card-body">
          <div class="icon">
            <font-awesome-icon :icon="['fas', 'ellipsis-v']" />
          </div>

          <div class="title-amount">
            <p class="title">Account balance</p>
            <p class="amount">1,234,567 RWF</p>
          </div>
        </div>
        <div class="card-bottom">
          <p>View All</p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>