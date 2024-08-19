<?php include('../templates/header.php'); ?>

<h2>Budget Overview</h2>

<!-- Budget Table -->
<table id="budget-table">
    <thead>
        <tr>
            <th>Category</th>
            <th>Limit</th>
            <th>Spent</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Rows will be populated dynamically by JavaScript -->
    </tbody>
</table>

<!-- Budget Chart -->
<canvas id="budget-chart" width="400" height="200"></canvas>

<!-- Create Budget Modal -->
<div id="create-budget-modal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-create-modal">&times;</span>
        <h3>Create Budget</h3>
        <form id="create-budget-form">
            <label for="create-category">Category:</label>
            <input type="text" id="create-category" name="category" required><br>
            <label for="create-limit">Limit:</label>
            <input type="number" id="create-limit" name="limit" required><br>
            <input type="submit" value="Create">
        </form>
    </div>
</div>

<!-- Edit Budget Modal -->
<div id="edit-budget-modal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-edit-modal">&times;</span>
        <h3>Edit Budget</h3>
        <form id="edit-budget-form">
            <input type="hidden" id="edit-id" name="id">
            <label for="edit-category">Category:</label>
            <input type="text" id="edit-category" name="category" required><br>
            <label for="edit-limit">Limit:</label>
            <input type="number" id="edit-limit" name="limit" required><br>
            <input type="submit" value="Save">
        </form>
    </div>
</div>

<!-- Delete Budget Modal -->
<div id="delete-budget-modal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-delete-modal">&times;</span>
        <h3>Are you sure you want to delete this budget?</h3>
        <form id="delete-budget-form">
            <input type="hidden" id="delete-id" name="id">
            <button type="button" id="confirm-delete">Yes, Delete</button>
            <button type="button" id="cancel-delete">Cancel</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js CDN -->
<script src="budget_overview.js"></script> <!-- Link to your JavaScript file -->

<?php include('../templates/footer.php'); ?>
