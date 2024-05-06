

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Review Form</title>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <link rel="stylesheet" href="css/rewiew.css">
</head>
<body>
<nav class="navbar navbar-expand-lg  fixed-top">
  <div class="container-fluid">
  
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="moreaboutkosovo.php">More about Kosovo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="history.php">History</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="contry.php">API</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              About me
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="aboutme.php">About me</a></li>
              <li><a class="dropdown-item" href="cv.php">CV</a></li>
              <li><a class="dropdown-item" href="rewiew.php">Review us!</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="contact.php">Contact me!</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">First Page</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<div id="app">
<div class="container">
<form id="reviewForm" method="post" target="blank" action="formcommit1.php" @submit.prevent="submitForm" >

        <h3>REVIEW US:</h3>
        <input type="text" v-model="formData.name" name="name" placeholder="Your name here" >
        <div class="msgerrorr" v-if="errors.name">{{ errors.name }}</div>
        <input type="email" v-model="formData.email" name="email" placeholder="Your email here" >
        <div class="msgerrorr" v-if="errors.email">{{ errors.email }}</div>
        <input type="text" v-model="formData.phone" name="phone" placeholder="Your phone number here" >
        <div class="msgerrorr" v-if="errors.phone">{{ errors.phone }}</div>
        <textarea v-model="formData.message" name="message" rows="7" placeholder="What do you want us to know about, anything to fix?" ></textarea>
        <div class="msgerrorr" v-if="errors.message">{{ errors.message }}</div>

        <div class="button-container">
            <button type="submit" :disabled="!validateForm">Send</button>
            <button type="button" @click="clearForm">CLEAR</button>
        </div>
    

     
    </form>
</div>
</div>

<div class="modal fade" id="formDataModal" tabindex="-1" aria-labelledby="formDataModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formDataModalLabel">Form Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Name: {{ formData.name }}</p>
        <p>Email: {{ formData.email }}</p>
        <p>Phone: {{ formData.phone }}</p>
        <p>Message: {{ formData.message }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Vue.js Script -->
<script>

  new Vue({
    el: '#app',  // Binding Vue instance to the element with id 'app'
    data: {
      // Data properties for form fields and validation errors
      formData: {
        name: '',
        email: '',
        phone: '',
        message: ''
      },
      errors: {}
    },
    methods: {
      // Method to validate form data
      validateForm() {   
    let errors = {};
       // Validation rules
    if (!this.formData.name) {
        errors.name = '*Name is required';
    }

    if (!this.formData.email) {
        errors.email = '*Email is required';
    } else if (!this.isValidEmail(this.formData.email)) {
        errors.email = '*Invalid email address';
    }

    if (!this.formData.phone) {
        errors.phone = '*Phone number is required';
    } else if (!/^\d+$/.test(this.formData.phone)) {
        errors.phone = '*Phone number must contain only numbers';
    }

    if (!this.formData.message) {
        errors.message = '*Message is required';
    }
      // Assign errors object to the Vue data property
    this.errors = errors;
      // Return true if there are no errors, false otherwise
    return Object.keys(errors).length === 0;
},
      isValidEmail(email) {     // Email validation logic
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
      },
          // Method to clear form data and errors
      clearForm() {
        this.formData = {
          name: '',
          email: '',
          phone: '',
          message: ''
        };
        this.errors = {};
      },
            // Method to show form data modal

      showModal() {
        $('#formDataModal').modal('show'); 
      },
      submitForm() {
    if (this.validateForm()) {
        // Submit the form programmatically
        document.getElementById('reviewForm').submit();
    }
}

    }
  });
</script>

</body>
</html>
