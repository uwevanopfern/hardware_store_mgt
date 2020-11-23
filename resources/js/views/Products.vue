<template>
  <div>
    <a-button class="editable-add-btn" @click="showModal" type="primary">
      Add
    </a-button>
    <a-table :data-source="products" :columns="columns">
      <div
        slot="filterDropdown"
        slot-scope="{
          setSelectedKeys,
          selectedKeys,
          confirm,
          clearFilters,
          column,
        }"
        style="padding: 8px"
      >
        <a-input
          v-ant-ref="(c) => (searchInput = c)"
          :placeholder="`Search ${column.dataIndex}`"
          :value="selectedKeys[0]"
          style="width: 188px; margin-bottom: 8px; display: block"
          @change="
            (e) => setSelectedKeys(e.target.value ? [e.target.value] : [])
          "
          @pressEnter="
            () => handleSearch(selectedKeys, confirm, column.dataIndex)
          "
        />
        <a-button
          type="primary"
          icon="search"
          size="small"
          style="width: 90px; margin-right: 8px"
          @click="() => handleSearch(selectedKeys, confirm, column.dataIndex)"
        >
          Search
        </a-button>
        <a-button
          size="small"
          style="width: 90px"
          @click="() => handleReset(clearFilters)"
        >
          Reset
        </a-button>
      </div>
      <a-icon
        slot="filterIcon"
        slot-scope="filtered"
        type="search"
        :style="{ color: filtered ? '#108ee9' : undefined }"
      />
      <template slot="customRender" slot-scope="text, record, index, column">
        <span v-if="searchText && searchedColumn === column.dataIndex">
          <template
            v-for="(fragment, i) in text
              .toString()
              .split(new RegExp(`(?<=${searchText})|(?=${searchText})`, 'i'))"
          >
            <mark
              v-if="fragment.toLowerCase() === searchText.toLowerCase()"
              :key="i"
              class="highlight"
              >{{ fragment }}</mark
            >
            <template v-else>{{ fragment }}</template>
          </template>
        </span>
        <template v-else>
          {{ text }}
        </template>
      </template>
    </a-table>
    <!-- Create product modal -->
    <a-modal
      title="New product"
      :visible="visible"
      :confirm-loading="confirmLoading"
      @ok="saveProduct"
      @cancel="handleCancel"
    >
      <a-form :form="form" @submit.prevent="saveProduct">
        <a-form-item
          :label-col="formItemLayout.labelCol"
          :wrapper-col="formItemLayout.wrapperCol"
          label="Name"
        >
          <a-input
            v-decorator="[
              'name',
              {
                rules: [
                  { required: true, message: 'Please input the product name' },
                ],
              },
            ]"
            placeholder="Product name"
            v-model="productForm.name"
          />
        </a-form-item>
        <a-form-item
          :label-col="formItemLayout.labelCol"
          :wrapper-col="formItemLayout.wrapperCol"
          label="Category"
        >
          <a-input
            v-decorator="[
              'category',
              {
                rules: [
                  {
                    required: true,
                    message: 'Please input the category',
                  },
                ],
              },
            ]"
            placeholder="Category"
            v-model="productForm.category"
          />
        </a-form-item>
        <a-form-item
          :label-col="formItemLayout.labelCol"
          :wrapper-col="formItemLayout.wrapperCol"
          label="Manufacturer"
        >
          <a-input
            v-decorator="[
              'manufacturer',
              {
                rules: [
                  {
                    required: true,
                    message: 'Please input the manufacturer',
                  },
                ],
              },
            ]"
            placeholder="Manufacturer ltd"
            v-model="productForm.manufacturer"
          />
        </a-form-item>
        <a-form-item
          :label-col="formItemLayout.labelCol"
          :wrapper-col="formItemLayout.wrapperCol"
          label="Purchase price"
        >
          <a-input
            v-decorator="[
              'Purchase price',
              {
                rules: [
                  {
                    required: true,
                    message: 'Please input the purchase price',
                  },
                ],
              },
            ]"
            placeholder="0 RWF"
            v-model="productForm.purchased_price"
          />
        </a-form-item>
        <a-form-item
          :label-col="formItemLayout.labelCol"
          :wrapper-col="formItemLayout.wrapperCol"
          label="Unit price"
        >
          <a-input
            v-decorator="[
              'Unit price',
              {
                rules: [
                  {
                    required: true,
                    message: 'Please input the unit price',
                  },
                ],
              },
            ]"
            placeholder="0 RWF"
            v-model="productForm.unit_price"
          />
        </a-form-item>
        <a-form-item
          :label-col="formItemLayout.labelCol"
          :wrapper-col="formItemLayout.wrapperCol"
          label="Weight"
        >
          <a-input
            v-decorator="[
              'Weight',
              {
                rules: [
                  {
                    required: true,
                    message: 'Please input the weight',
                  },
                ],
              },
            ]"
            placeholder="1kg / 1l"
            v-model="productForm.weight"
          />
        </a-form-item>
        <a-form-item
          :label-col="formItemLayout.labelCol"
          :wrapper-col="formItemLayout.wrapperCol"
          label="Quantity"
        >
          <a-input
            v-decorator="[
              'Quantity',
              {
                rules: [
                  {
                    required: true,
                    message: 'Please input the quantity',
                  },
                ],
              },
            ]"
            placeholder="0"
            v-model="productForm.quantity"
          />
        </a-form-item>
      </a-form>
    </a-modal>
  </div>
</template>

<script>
const formItemLayout = {
  labelCol: { span: 6 },
  wrapperCol: { span: 12 },
};
const formTailLayout = {
  labelCol: { span: 4 },
  wrapperCol: { span: 8, offset: 4 },
};
export default {
  data() {
    return {
      searchText: "",
      searchInput: null,
      searchedColumn: "",
      columns: [
        {
          title: "Name",
          dataIndex: "name",
          key: "name",
          scopedSlots: {
            filterDropdown: "filterDropdown",
            filterIcon: "filterIcon",
            customRender: "customRender",
          },
          onFilter: (value, record) =>
            record.name.toString().toLowerCase().includes(value.toLowerCase()),
          onFilterDropdownVisibleChange: (visible) => {
            if (visible) {
              setTimeout(() => {
                this.searchInput.focus();
              }, 0);
            }
          },
        },
        {
          title: "Category",
          dataIndex: "category",
          key: "category",
          scopedSlots: {
            filterDropdown: "filterDropdown",
            filterIcon: "filterIcon",
            customRender: "customRender",
          },
          onFilter: (value, record) =>
            record.age.toString().toLowerCase().includes(value.toLowerCase()),
          onFilterDropdownVisibleChange: (visible) => {
            if (visible) {
              setTimeout(() => {
                this.searchInput.focus();
              });
            }
          },
        },
        {
          title: "Manufacturer",
          dataIndex: "manufacturer",
          key: "manufacturer",
          scopedSlots: {
            filterDropdown: "filterDropdown",
            filterIcon: "filterIcon",
            customRender: "customRender",
          },
          onFilter: (value, record) =>
            record.address
              .toString()
              .toLowerCase()
              .includes(value.toLowerCase()),
          onFilterDropdownVisibleChange: (visible) => {
            if (visible) {
              setTimeout(() => {
                this.searchInput.focus();
              });
            }
          },
        },
        {
          title: "Purchase price",
          dataIndex: "stock.purchased_price",
          key: "purchase price",
          scopedSlots: {
            filterDropdown: "filterDropdown",
            filterIcon: "filterIcon",
            customRender: "customRender",
          },
          onFilter: (value, record) =>
            record.address
              .toString()
              .toLowerCase()
              .includes(value.toLowerCase()),
          onFilterDropdownVisibleChange: (visible) => {
            if (visible) {
              setTimeout(() => {
                this.searchInput.focus();
              });
            }
          },
        },
        {
          title: "Unit price",
          dataIndex: "stock.unit_price",
          key: "unit price",
          scopedSlots: {
            filterDropdown: "filterDropdown",
            filterIcon: "filterIcon",
            customRender: "customRender",
          },
          onFilter: (value, record) =>
            record.address
              .toString()
              .toLowerCase()
              .includes(value.toLowerCase()),
          onFilterDropdownVisibleChange: (visible) => {
            if (visible) {
              setTimeout(() => {
                this.searchInput.focus();
              });
            }
          },
        },
        {
          title: "Weight",
          dataIndex: "weight",
          key: "weight",
          scopedSlots: {
            filterDropdown: "filterDropdown",
            filterIcon: "filterIcon",
            customRender: "customRender",
          },
          onFilter: (value, record) =>
            record.address
              .toString()
              .toLowerCase()
              .includes(value.toLowerCase()),
          onFilterDropdownVisibleChange: (visible) => {
            if (visible) {
              setTimeout(() => {
                this.searchInput.focus();
              });
            }
          },
        },
        {
          title: "Quantity",
          dataIndex: "stock.quantity",
          key: "quantity",
          scopedSlots: {
            filterDropdown: "filterDropdown",
            filterIcon: "filterIcon",
            customRender: "customRender",
          },
          onFilter: (value, record) =>
            record.address
              .toString()
              .toLowerCase()
              .includes(value.toLowerCase()),
          onFilterDropdownVisibleChange: (visible) => {
            if (visible) {
              setTimeout(() => {
                this.searchInput.focus();
              });
            }
          },
        },
      ],
      ModalText: "Content of the modal",
      visible: false,
      confirmLoading: false,
      checkNick: false,
      formItemLayout,
      formTailLayout,
      form: this.$form.createForm(this, { name: "dynamic_rule" }),
      productForm: {
        name: "",
        quantity: "",
        manufacturer: "",
        category: "",
        weight: "",
        purchased_price: "",
        unit_price: "",
      },
      products: [],
    };
  },
  mounted() {
    this.loadProduct();
  },
  methods: {
    handleSearch(selectedKeys, confirm, dataIndex) {
      confirm();
      this.searchText = selectedKeys[0];
      this.searchedColumn = dataIndex;
    },

    handleReset(clearFilters) {
      clearFilters();
      this.searchText = "";
    },
    showModal() {
      this.visible = true;
    },
    handleOk(e) {
      this.ModalText = "The modal will be closed after two seconds";
      this.confirmLoading = true;
      setTimeout(() => {
        this.visible = false;
        this.confirmLoading = false;
      }, 2000);
    },
    handleCancel(e) {
      console.log("Clicked cancel button");
      this.visible = false;
    },
    check() {
      this.form.validateFields((err) => {
        if (!err) {
          console.info("success");
        }
      });
    },
    handleChange(e) {
      this.checkNick = e.target.checked;
      this.$nextTick(() => {
        this.form.validateFields(["nickname"], { force: true });
      });
    },
    /**
     * Save product
     */
    saveProduct() {
      console.log("form", this.productForm);
      try {
        const res = this.$http.post(
          this.$store.state.api.path.postProduct,
          this.productForm,
          {
            headers: {
              Authorization: `Bearer ${this.$store.state.api.token}`,
            },
          }
        );
        console.log("created", res);
      } catch (e) {
        console.error(e);
      }
    },
    /**
     * Load products
     */
    async loadProduct() {
      try {
        const res = await this.$http.get(
          this.$store.state.api.path.getProduct,
          {
            headers: {
              Authorization: `Bearer ${this.$store.state.api.token}`,
            },
          }
        );
        console.log("loaded", res.data.data);
        this.products = res.data.data;
      } catch (e) {
        console.error(e);
      }
    },
  },
};
</script>
<style lang='scss'>
.highlight {
  background-color: rgb(255, 192, 105);
  padding: 0px;
}
.ant-modal {
  top: 55px !important;
}
</style>
