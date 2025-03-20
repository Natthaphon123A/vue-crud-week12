<template>
    <div class="container mt-5">
      <h2 class="text-center mb-4">Customer Management</h2>
      <div class="text-center mb-4">
        <button class="btn btn-primary btn-lg" @click="showAddModal">
          <i class="bi bi-plus-circle me-2"></i>Add Customer
        </button>
      </div>
  
      
      <table class="table table-striped table-bordered shadow-sm">
        <thead class="table-dark">
          <tr>
            <th>Customer ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Username</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="customer in customers" :key="customer.id">
            <td>{{ customer.id }}</td>
            <td>{{ customer.first_name }}</td>
            <td>{{ customer.last_name }}</td>
            <td>{{ customer.phone_number }}</td>
            <td>{{ customer.username }}</td>
            <td>
              <button class="btn btn-warning btn-sm me-2" @click="showEditModal(customer)">
                <i class="bi bi-pencil-square"></i> Edit
              </button>
              <button class="btn btn-danger btn-sm" @click="showDeleteModal(customer)">
                <i class="bi bi-trash"></i> Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
  
      
      <div v-if="showModal" class="modal fade show d-block" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ isEdit ? 'Edit Customer' : 'Add Customer' }}</h5>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">First Name</label>
                <input v-model="form.first_name" class="form-control" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input v-model="form.last_name" class="form-control" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input v-model="form.phone_number" class="form-control" />
              </div>
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input v-model="form.username" class="form-control" required />
              </div>
              <div v-if="!isEdit" class="mb-3">
                <label class="form-label">Password</label>
                <input v-model="form.password" type="password" class="form-control" required />
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="addOrUpdateCustomer">
                {{ isEdit ? 'Update' : 'Add' }}
              </button>
              <button class="btn btn-secondary" @click="closeModal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
  
      
      <div v-if="showDeleteConfirm" class="modal fade show d-block" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">ConFirm Delete</h5>
            </div>
            <div class="modal-body">
              <p>คณเเน่ใจใช่หรือไม่? ที่จะลบรายการนี้ออก</p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-danger" @click="deleteCustomer">Yes</button>
              <button class="btn btn-secondary" @click="closeDeleteModal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        customers: [],
        showModal: false,
        showDeleteConfirm: false,
        isEdit: false,
        form: {
          id: null,
          first_name: '',
          last_name: '',
          phone_number: '',
          username: '',
          password: ''
        },
        customerToDelete: null
      };
    },
    methods: {
      async fetchCustomers() {
        const response = await axios.get('http://localhost:8080/api_1/customers.php');
        this.customers = response.data;
      },
      showAddModal() {
        this.isEdit = false;
        this.form = { id: null, first_name: '', last_name: '', phone_number: '', username: '', password: '' };
        this.showModal = true;
      },
      showEditModal(customer) {
        this.isEdit = true;
        this.form = { ...customer };
        this.showModal = true;
      },
      showDeleteModal(customer) {
        this.customerToDelete = customer;
        this.showDeleteConfirm = true;
      },
      async addOrUpdateCustomer() {
        if (this.isEdit) {
          await axios.put('http://localhost:8080/api_1/customers.php', this.form);
        } else {
          await axios.post('http://localhost:8080/api_1/customers.php', this.form);
        }
        this.closeModal();
        this.fetchCustomers();
      },
      async deleteCustomer() {
        await axios.delete(`http://localhost:8080/api_1/customers.php?id=${this.customerToDelete.id}`);
        this.closeDeleteModal();
        this.fetchCustomers();
      },
      closeModal() {
        this.showModal = false;
      },
      closeDeleteModal() {
        this.showDeleteConfirm = false;
        this.customerToDelete = null;
      }
    },
    mounted() {
      this.fetchCustomers();
    }
  };
  </script>
  
  <style>
  h2 {
    font-size: 2.5rem;
    color: #2c3e50;
    font-weight: 600;
  }
  .btn-primary {
    background-color: #42b983;
    border-color: #42b983;
    transition: background-color 0.3s;
  }
  .btn-primary:hover {
    background-color: #369c6a;
    border-color: #369c6a;
  }
  .table {
    border-radius: 8px;
    overflow: hidden;
  }
  .table th {
    background-color: #2c3e50;
  }
  .modal-content {
    border-radius: 10px;
  }
  .modal-header {
    background-color: #f8f9fa;
    border-bottom: none;
  }
  .modal-footer {
    border-top: none;
  }
  </style>