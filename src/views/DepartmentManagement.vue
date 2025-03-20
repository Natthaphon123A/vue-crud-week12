<template>
    <div class="container mt-5">
      <h2 class="text-center mb-4">Department Management</h2>
      <div class="text-center mb-4">
        <button class="btn btn-primary btn-lg" @click="showAddModal">
          <i class="bi bi-plus-circle me-2"></i>Add Department
        </button>
      </div>
  
      
      <table class="table table-striped table-bordered shadow-sm">
        <thead class="table-dark">
          <tr>
            <th>Department ID</th>
            <th>Department Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="department in departments" :key="department.id">
            <td>{{ department.id }}</td>
            <td>{{ department.name }}</td>
            <td>
              <button class="btn btn-warning btn-sm me-2" @click="showEditModal(department)">
                <i class="bi bi-pencil-square"></i> Edit
              </button>
              <button class="btn btn-danger btn-sm" @click="showDeleteModal(department)">
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
              <h5 class="modal-title">{{ isEdit ? 'Edit Department' : 'Add Department' }}</h5>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Department Name</label>
                <input v-model="form.name" class="form-control" required />
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="addOrUpdateDepartment">
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
              <h5 class="modal-title">Confirm Delete</h5>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete this department?</p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-danger" @click="deleteDepartment">Yes</button>
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
        departments: [],
        showModal: false,
        showDeleteConfirm: false,
        isEdit: false,
        form: {
          id: null,
          name: ''
        },
        departmentToDelete: null
      };
    },
    methods: {
      async fetchDepartments() {
        const response = await axios.get('http://localhost:8080/api_1/departments.php');
        this.departments = response.data;
      },
      showAddModal() {
        this.isEdit = false;
        this.form = { id: null, name: '' };
        this.showModal = true;
      },
      showEditModal(department) {
        this.isEdit = true;
        this.form = { ...department };
        this.showModal = true;
      },
      showDeleteModal(department) {
        this.departmentToDelete = department;
        this.showDeleteConfirm = true;
      },
      async addOrUpdateDepartment() {
        if (this.isEdit) {
          await axios.put('http://localhost:8080/api_1/departments.php', this.form);
        } else {
          await axios.post('http://localhost:8080/api_1/departments.php', this.form);
        }
        this.closeModal();
        this.fetchDepartments();
      },
      async deleteDepartment() {
        await axios.delete(`http://localhost:8080/api_1/departments.php?id=${this.departmentToDelete.id}`);
        this.closeDeleteModal();
        this.fetchDepartments();
      },
      closeModal() {
        this.showModal = false;
      },
      closeDeleteModal() {
        this.showDeleteConfirm = false;
        this.departmentToDelete = null;
      }
    },
    mounted() {
      this.fetchDepartments();
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