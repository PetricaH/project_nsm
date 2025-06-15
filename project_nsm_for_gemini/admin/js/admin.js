/**
 * Admin Panel JavaScript
 * Handles responsive sidebar, notifications, and other common functionality
 */
document.addEventListener('DOMContentLoaded', function() {
  initAdminPanel();
});

function initAdminPanel() {
  // Mobile sidebar toggle
  setupSidebar();
  
  // Notification close buttons
  setupNotifications();
  
  // CKEditor initialization for textareas with the ckeditor class
  initCKEditor();
  
  // Form validation
  setupFormValidation();
  
  // Fix paths for images and form actions
  fixRelativePaths();
}

/**
* Setup sidebar responsiveness and toggle
*/
function setupSidebar() {
  const sidebarToggle = document.getElementById('sidebarToggle');
  const sidebar = document.querySelector('.admin-sidebar');
  
  if (sidebarToggle && sidebar) {
      sidebarToggle.addEventListener('click', function() {
          sidebar.classList.toggle('active');
      });
      
      // Close sidebar when clicking outside on mobile
      document.addEventListener('click', function(event) {
          const isMobile = window.innerWidth < 768;
          const isClickInsideSidebar = sidebar.contains(event.target);
          const isClickOnToggle = sidebarToggle.contains(event.target);
          
          if (isMobile && !isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('active')) {
              sidebar.classList.remove('active');
          }
      });
  }
}

/**
* Setup notification close functionality
*/
function setupNotifications() {
  const notifications = document.querySelectorAll('.notification');
  
  notifications.forEach(notification => {
      // Add close button if not present
      if (!notification.querySelector('.notification-close')) {
          const closeBtn = document.createElement('button');
          closeBtn.className = 'notification-close';
          closeBtn.innerHTML = '&times;';
          notification.appendChild(closeBtn);
      }
      
      // Add click event to close button
      const closeBtn = notification.querySelector('.notification-close');
      if (closeBtn) {
          closeBtn.addEventListener('click', function() {
              notification.style.opacity = '0';
              setTimeout(() => {
                  notification.style.display = 'none';
              }, 300);
          });
      }
      
      // Auto-hide notifications after 5 seconds
      setTimeout(() => {
          notification.style.opacity = '0';
          setTimeout(() => {
              notification.style.display = 'none';
          }, 300);
      }, 5000);
  });
}

/**
* Initialize CKEditor for rich text editing
*/
function initCKEditor() {
  // Check if CKEditor is available
  if (typeof CKEDITOR !== 'undefined') {
      // Initialize CKEditor for all textareas with the ckeditor class
      document.querySelectorAll('textarea.ckeditor').forEach(textarea => {
          CKEDITOR.replace(textarea.id, {
              height: 300,
              entities: false,
              toolbar: [
                  { name: 'document', items: ['Source'] },
                  { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
                  { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll'] },
                  { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
                  { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                  { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
                  { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar'] },
                  { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                  { name: 'colors', items: ['TextColor', 'BGColor'] },
                  { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
              ]
          });
      });
  }
}

/**
* Setup basic form validation
*/
function setupFormValidation() {
  const forms = document.querySelectorAll('form[data-validate="true"]');
  
  forms.forEach(form => {
      form.addEventListener('submit', function(event) {
          const requiredFields = form.querySelectorAll('[required]');
          let isValid = true;
          
          requiredFields.forEach(field => {
              if (!field.value.trim()) {
                  isValid = false;
                  field.classList.add('error');
                  
                  // Add error message if not already present
                  const fieldParent = field.parentElement;
                  if (!fieldParent.querySelector('.error-message')) {
                      const errorMsg = document.createElement('div');
                      errorMsg.className = 'error-message';
                      errorMsg.textContent = 'This field is required';
                      fieldParent.appendChild(errorMsg);
                  }
              } else {
                  field.classList.remove('error');
                  const fieldParent = field.parentElement;
                  const errorMsg = fieldParent.querySelector('.error-message');
                  if (errorMsg) {
                      fieldParent.removeChild(errorMsg);
                  }
              }
          });
          
          if (!isValid) {
              event.preventDefault();
          }
      });
  });
}

/**
* Fix relative paths for assets and form actions
*/
function fixRelativePaths() {
  // Fix image paths
  document.querySelectorAll('img[src]').forEach(img => {
      const src = img.getAttribute('src');
      if (src && src.startsWith('static/')) {
          img.src = '/' + src;
      }
  });
  
  // Fix form actions
  document.querySelectorAll('form[action]').forEach(form => {
      const action = form.getAttribute('action');
      if (action && action.includes('admin_includes') && !action.startsWith('/')) {
          form.action = '/' + action;
      }
  });
}

/**
* Helper to create notification messages dynamically
* @param {string} message - The message to display
* @param {string} type - The type of notification (success, error, warning, info)
*/
function showNotification(message, type = 'info') {
  // Create notification element
  const notification = document.createElement('div');
  notification.className = `notification ${type}`;
  
  // Create message element
  const messageEl = document.createElement('span');
  messageEl.className = 'notification-message';
  messageEl.textContent = message;
  
  // Create close button
  const closeBtn = document.createElement('button');
  closeBtn.className = 'notification-close';
  closeBtn.innerHTML = '&times;';
  
  // Add elements to notification
  notification.appendChild(messageEl);
  notification.appendChild(closeBtn);
  
  // Add notification to the content wrapper
  const contentWrapper = document.querySelector('.content-wrapper');
  if (contentWrapper) {
      // Add at the beginning, before any other content
      contentWrapper.insertBefore(notification, contentWrapper.firstChild);
      
      // Setup close button
      closeBtn.addEventListener('click', function() {
          notification.style.opacity = '0';
          setTimeout(() => {
              notification.remove();
          }, 300);
      });
      
      // Auto-hide after 5 seconds
      setTimeout(() => {
          notification.style.opacity = '0';
          setTimeout(() => {
              notification.remove();
          }, 300);
      }, 5000);
  }
}

/**
* Handle image preview for file inputs
* @param {HTMLElement} fileInput - The file input element
* @param {HTMLElement} previewElement - The element to display the preview
*/
function handleImagePreview(fileInput, previewElement) {
  if (!fileInput || !previewElement) return;
  
  fileInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (!file) return;
      
      const reader = new FileReader();
      reader.onload = function(event) {
          previewElement.innerHTML = `<img src="${event.target.result}" alt="Preview">`;
          previewElement.classList.add('has-image');
      };
      reader.readAsDataURL(file);
  });
}

/**
* Create a confirmation dialog
* @param {string} message - The confirmation message
* @param {Function} onConfirm - Function to call when confirmed
* @param {Function} onCancel - Function to call when canceled
*/
function confirmAction(message, onConfirm, onCancel = null) {
  // Create modal element
  const modal = document.createElement('div');
  modal.className = 'admin-modal';
  
  // Create modal content
  modal.innerHTML = `
      <div class="modal-content">
          <div class="modal-header">
              <h3>Confirm Action</h3>
              <button class="modal-close">&times;</button>
          </div>
          <div class="modal-body">
              <p>${message}</p>
          </div>
          <div class="modal-footer">
              <button class="btn btn-danger" id="confirmYes">Yes, Proceed</button>
              <button class="btn btn-secondary" id="confirmNo">Cancel</button>
          </div>
      </div>
  `;
  
  // Add modal to body
  document.body.appendChild(modal);
  
  // Show modal
  setTimeout(() => {
      modal.classList.add('active');
  }, 50);
  
  // Setup event listeners
  const closeBtn = modal.querySelector('.modal-close');
  const confirmYes = modal.querySelector('#confirmYes');
  const confirmNo = modal.querySelector('#confirmNo');
  
  // Close function
  const closeModal = () => {
      modal.classList.remove('active');
      setTimeout(() => {
          document.body.removeChild(modal);
      }, 300);
  };
  
  // Close button event
  closeBtn.addEventListener('click', () => {
      closeModal();
      if (onCancel) onCancel();
  });
  
  // Confirm button event
  confirmYes.addEventListener('click', () => {
      closeModal();
      onConfirm();
  });
  
  // Cancel button event
  confirmNo.addEventListener('click', () => {
      closeModal();
      if (onCancel) onCancel();
  });
  
  // Close on click outside
  modal.addEventListener('click', (e) => {
      if (e.target === modal) {
          closeModal();
          if (onCancel) onCancel();
      }
  });
}

// Expose utility functions globally for use in page-specific scripts
window.adminUtils = {
  showNotification,
  handleImagePreview,
  confirmAction
};