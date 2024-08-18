<script setup lang="ts">
import { ref, onMounted } from "vue";
import InputText from "primevue/inputtext";
import DatePicker from "primevue/datepicker";
import RadioButton from "primevue/radiobutton";
import Select from "primevue/select";
import Button from "primevue/button";
import type { Employee } from "~/model/EmployeeModel";
import { useToast } from "primevue/usetoast";
import { useConfirm } from "primevue/useconfirm";
import { handleDeleteForm } from "~/utils/DeleteForm";
import FileUpload from "primevue/fileupload";
import { getProperty } from "~/utils/GetProperty";
import { uploadImage } from "~/utils/UploadImage";

const props = defineProps({
  employee: {
    type: Object as () => Employee,
    required: true,
  },
  formType: {
    type: String,
    required: true,
  },
});


const religions = ref([]);
const unit = ref([]);
const group = ref([]);
const eselon = ref([]);
const workplace = ref([]);
const loading = ref(false);
const config = useRuntimeConfig();
const toast = useToast();
const confirm = useConfirm();
const fileUpload = ref();
const imageUrl = `${config.public.appBase}/storage/${props.employee.image_url}`;

onMounted(async () => {
  loading.value = true;
  try {
    const property = await getProperty();
    religions.value = property.data.religion;
    unit.value = property.data.unit;
    group.value = property.data.group;
    eselon.value = property.data.eselon;
    workplace.value = property.data.workplace;
  } catch (error) {
    console.error("Error fetching data:", error);
  } finally {
    loading.value = false;
  }
});

const onSubmit = () => handleSubmitForm(props.employee, toast);
const onUpdate = () => console.log(props.employee);
const onDelete = () => {
  confirm.require({
    message: "Do you want to delete this record?",
    header: "Danger Zone",
    icon: "pi pi-info-circle",
    rejectLabel: "Cancel",
    rejectProps: {
      label: "Cancel",
      severity: "secondary",
      outlined: true,
    },
    acceptProps: {
      label: "Delete",
      severity: "danger",
    },
    accept: () => {
      handleDeleteForm(props.employee.nip, toast);
    },
  });
};

const upload = async () => {
  if (fileUpload.value) {
    let formData = new FormData();
    formData.append("image", fileUpload.value.files[0]);
    try {
      await uploadImage(props.employee.nip, formData, toast)
    } catch (error) {
      console.log(error)
    }
  }
};

</script>

<template>
  <Toast />
  <ConfirmDialog></ConfirmDialog>
  <form class="form" @submit.prevent="onSubmit">
    <div class="form-group" v-if="props.formType == 'update'">
        <div style="display: flex; justify-content: center">
        <div
          style="
            border-radius: 100px;
            width: 200px;
            height: 200px;
            border: 2px solid #ddd;
            overflow: hidden;
          "
        >
          <img
            :src="imageUrl"
            alt="Employee Photo"
            style="height: 200px; width: 200px; object-fit: cover"
            v-if="props.employee.image_url !== null"
          />
        </div>
      </div>
    </div>
    
    <div class="form-group">
      <label for="nip">NIP</label>
      <InputText
        id="nip"
        v-model="props.employee.nip"
        required
        :disabled="props.formType == 'update'"
      />
    </div>
    <div class="form-group">
      <label for="name">Name</label>
      <InputText id="name" v-model="props.employee.name" required/>
    </div>
    <div class="form-group-multi">
      <div>
        <label for="birthplace">Birthplace</label>
        <InputText id="birthplace" v-model="props.employee.birthplace" required/>
      </div>
      <div>
        <label for="birthdate">Birthdate</label>
        <DatePicker
          showIcon
          fluid
          required
          iconDisplay="input"
          dateFormat="yy/mm/dd"
          v-model="props.employee.birthdate"
        />
      </div>
      <div class="form-group">
        <label for="gender">Gender</label>
        <div class="radio-wrapper">
          <div class="radio-button">
            <RadioButton
              v-model="props.employee.gender"
              input-id="M"
              value="M"
            />
            <label for="M">M</label>
          </div>
          <div class="radio-button">
            <RadioButton
              v-model="props.employee.gender"
              input-id="F"
              value="F"
            />
            <label for="F">F</label>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <InputText id="address" v-model="props.employee.address" required/>
    </div>
    <div class="form-group">
      <label for="religion">Religion</label>
      <Select
        v-model="props.employee.religion"
        :options="religions"
        optionLabel="name"
        optionValue="id"
        placeholder="Select Religion"
        class="form-field"
      />
    </div>
    <div class="form-group">
      <label for="group">Group</label>
      <Select
        v-model="props.employee.group"
        :options="group"
        optionLabel="name"
        required
        optionValue="id"
        placeholder="Select Group"
        class="form-field"
      />
    </div>
    <div class="form-group">
      <label for="eselon">Eselon</label>
      <Select
        v-model="props.employee.eselon"
        :options="eselon"
        showClear
        optionLabel="name"
        optionValue="id"
        placeholder="Select Eselon"
        class="form-field"
      />
    </div>
    <div class="form-group">
      <label for="position">Position</label>
      <InputText id="position" v-model="props.employee.position" required/>
    </div>
    <div class="form-group">
      <label for="workplace">Workplace</label>
      <Select
        v-model="props.employee.workplace"
        :options="workplace"
        optionLabel="name"
        optionValue="id"
        required
        filter
        placeholder="Select Workplace"
        class="form-field"
      />
    </div>
    <div class="form-group">
      <label for="unit">Unit</label>
      <Select
        v-model="props.employee.unit"
        :options="unit"
        optionLabel="name"
        optionValue="id"
        required
        filter
        placeholder="Select Unit"
        class="form-field"
      />
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <InputText id="phone" v-model="props.employee.phone" />
    </div>
    <div class="form-group">
      <label for="npwp">NPWP</label>
      <InputText id="npwp" v-model="props.employee.npwp" />
    </div>
    <div class="form-group" v-if="props.formType == 'update'">
      <label for="photo">Photo Upload</label>
    <div class="form-group-multi">
        <FileUpload
          ref="fileUpload"
          mode="basic"
          name="photo"
          accept="image/*"
          :maxFileSize="1000000"
        />
        <Button label="Upload" @click="upload" severity="secondary" />
      </div>
    </div>
    <div v-if="props.formType == 'post'">
      <Button label="Submit" type="submit" />
    </div>
    <div
      v-if="props.formType == 'update'"
      style="display: flex; gap: 6px; justify-content: end"
    >
      <Button @click="onDelete()" label="Delete" severity="danger" />
      <Button @click="onUpdate()" label="Update" severity="success" />
    </div>
  </form>
</template>

<style scoped>
.form {
  width: 50%;
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-bottom: 1rem;
}

.form-group-multi {
  display: flex;
  gap: 1rem;
}

.form-field {
  width: 100%;
}

label {
  display: block;
  margin-bottom: 0.8rem;
}

input {
  width: 100%;
  padding: 0.5rem;
}

.radio-wrapper {
  display: flex;
  gap: 0.8rem;
}

.radio-button {
  display: flex;
  gap: 0.2rem;
}
</style>
