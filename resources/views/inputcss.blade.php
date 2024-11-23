<style>
/* Container for input fields */
.input-fields-container {
    display: flex;
    gap: 15px; /* Space between input groups */
    flex-wrap: wrap; /* Allow wrapping when screen size is small */
    justify-content: flex-start; /* Align items to the left */
}

/* Custom card for the input fields */
.custom-card {
    width: 100%;
    max-width: 300px; /* Card width can be adjusted */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 15px;
    background-color: #fff;
    margin-bottom: 15px; /* Space between cards */
    display: flex;
    flex-direction: column;
}

/* Custom form fields */
.custom-form-group {
    margin-bottom: 10px;
}

.custom-form-group label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
}

.custom-form-group input, 
.custom-form-group select {
    width: 100%;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.custom-remove-btn {
    margin-top: 10px;
    padding: 6px 12px;
    background-color: #e74c3c;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.custom-remove-btn:hover {
    background-color: #c0392b;
}

.custom-add-btn {
    margin-top: 20px;
    padding: 10px 15px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.custom-add-btn:hover {
    background-color: #2980b9;
}

.custom-submit-btn {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #2ecc71;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.custom-submit-btn:hover {
    background-color: #27ae60;
}
</style>
