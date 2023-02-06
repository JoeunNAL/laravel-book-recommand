<section class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">로그내역</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="container table table-hover">
          <thead>
            <tr>
              <th scope="col ellipsis-1">일/시</th>
              <th scope="col">내역</th>
            </tr>
          </thead>
          <tbody id="log-table"></tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<script src="assets/logModal.js"></script>