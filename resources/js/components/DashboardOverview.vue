<template>
  <div>
    <div class="row">
      <div class="row-title">
        <p>Overview</p>
      </div>
      <div class="overview-cards">
        <div class="card-item">
          <div class="card-body">
            <div class="icon">
              <font-awesome-icon :icon="['fas', 'balance-scale']" />
            </div>

            <div class="title-amount">
              <p class="title">Account balance</p>
              <p class="amount">1,234,567 RWF</p>
            </div>
          </div>
          <div class="card-footer">
            <p>View All</p>
          </div>
        </div>
        <div class="card-item">
          <div class="card-body">
            <div class="icon">
              <font-awesome-icon :icon="['fas', 'sync-alt']" />
            </div>

            <div class="title-amount">
              <p class="title">Pending</p>
              <p class="amount">345,000 RWF</p>
            </div>
          </div>
          <div class="card-footer">
            <p>View All</p>
          </div>
        </div>
        <div class="card-item">
          <div class="card-body">
            <div class="icon">
              <font-awesome-icon :icon="['fas', 'check-circle']" />
            </div>

            <div class="title-amount">
              <p class="title">Sales (Last 30 days)</p>
              <p class="amount">15,200,100 RWF</p>
            </div>
          </div>
          <div class="card-footer">
            <p>View All</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="row-title">
        <p>Recent activity</p>
      </div>
      <a-table :columns="columns" :data-source="data">
        <a slot="name" slot-scope="text">{{ text }}</a>
        <span slot="customTitle"><a-icon type="smile-o" /> Name</span>
        <span slot="tags" slot-scope="tags">
          <a-tag
            v-for="tag in tags"
            :key="tag"
            :color="
              tag === 'loser'
                ? 'volcano'
                : tag.length > 5
                ? 'geekblue'
                : 'green'
            "
          >
            {{ tag.toUpperCase() }}
          </a-tag>
        </span>
        <span slot="action" slot-scope="text, record">
          <a>Invite 一 {{ record.name }}</a>
          <a-divider type="vertical" />
          <a>Delete</a>
          <a-divider type="vertical" />
          <a class="ant-dropdown-link"> More actions <a-icon type="down" /> </a>
        </span>
      </a-table>
    </div>
  </div>
</template>
<script>
const columns = [
  {
    dataIndex: "name",
    key: "name",
    slots: { title: "customTitle" },
    scopedSlots: { customRender: "name" },
  },
  {
    title: "Age",
    dataIndex: "age",
    key: "age",
  },
  {
    title: "Address",
    dataIndex: "address",
    key: "address",
  },
  {
    title: "Tags",
    key: "tags",
    dataIndex: "tags",
    scopedSlots: { customRender: "tags" },
  },
  {
    title: "Action",
    key: "action",
    scopedSlots: { customRender: "action" },
  },
];

const data = [
  {
    key: "1",
    name: "John Brown",
    age: 32,
    address: "New York No. 1 Lake Park",
    tags: ["nice", "developer"],
  },
  {
    key: "2",
    name: "Jim Green",
    age: 42,
    address: "London No. 1 Lake Park",
    tags: ["loser"],
  },
  {
    key: "3",
    name: "Joe Black",
    age: 32,
    address: "Sidney No. 1 Lake Park",
    tags: ["cool", "teacher"],
  },
];
export default {
  data() {
    return {
      data,
      columns,
    };
  },
};
</script>