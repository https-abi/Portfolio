<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "portfolio");

// ── Handle status change ───────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_status'])) {
    $id     = (int) $_POST['id'];
    $status = $_POST['status'];
    if (in_array($status, ['Unread', 'Read'])) {
        mysqli_query($conn, "UPDATE contacts SET status='$status' WHERE id=$id");
    }
    header("Location: contact_management.php");
    exit();
}

// ── Handle delete ──────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = (int) $_POST['id'];
    mysqli_query($conn, "DELETE FROM contacts WHERE id=$id");
    header("Location: contact_management.php");
    exit();
}

// ── Fetch all contacts ─────────────────────────────────────────
$result   = mysqli_query($conn, "SELECT * FROM contacts ORDER BY datetime DESC");
$contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);

$current_page = 'contact_management';
$page_title   = 'Contact Management';
require 'header.php';
?>

<div class="contact-management page">
    <div class="cm-header">
        <h1 class="admin-title">Contact Management</h1>
        <a href="admin.php" class="btn btn-ghost">Logout</a>
    </div>

    <?php if (empty($contacts)): ?>
        <p class="no-messages">No messages yet.</p>
    <?php else: ?>

    <div class="table-wrap">
        <table class="cm-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $i => $row): ?>
                <?php 
                    $dateStr = date('M d, Y h:i A', strtotime($row['datetime']));
                    $snippet = mb_strimwidth($row['message'], 0, 40, "...");
                ?>
                <tr class="status-<?php echo strtolower($row['status']); ?>" onclick="openMsgModal(this)">
                    <td style="display:none;" class="full-name"><?php echo htmlspecialchars($row['name']); ?></td>
                    <td style="display:none;" class="full-email"><?php echo htmlspecialchars($row['email']); ?></td>
                    <td style="display:none;" class="full-date"><?php echo htmlspecialchars($dateStr); ?></td>
                    <td style="display:none;" class="full-msg"><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                    
                    <td><?php echo $i + 1; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td class="msg-snippet"><?php echo htmlspecialchars($snippet); ?></td>
                    <td><?php echo $dateStr; ?></td>
                    <td>
                        <span class="badge badge-<?php echo strtolower($row['status']); ?>">
                            <?php echo $row['status']; ?>
                        </span>
                    </td>
                    <td class="action-cell" onclick="event.stopPropagation();">
                        <!-- Toggle Status -->
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <?php if ($row['status'] === 'Unread'): ?>
                                <input type="hidden" name="status" value="Read">
                                <button type="submit" name="change_status" class="btn-action">Mark Read</button>
                            <?php else: ?>
                                <input type="hidden" name="status" value="Unread">
                                <button type="submit" name="change_status" class="btn-action">Mark Unread</button>
                            <?php endif; ?>
                        </form>

                        <!-- Delete -->
                        <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this message?');">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete" class="btn-action btn-del">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

<!-- Modal -->
<div id="msgModal" class="modal-overlay" onclick="closeMsgModal(event)">
    <div class="modal-card">
        <span class="modal-close" onclick="closeMsgModal(event, true)">&times;</span>
        <h2 id="modalName">Name</h2>
        <div class="modal-meta">
            <span id="modalEmail">email@example.com</span> | <span id="modalDate">Date</span>
        </div>
        <div class="divider" style="margin: 1rem 0;"></div>
        <p id="modalMsg" class="modal-body"></p>
        
        <div class="modal-footer">
            <a id="modalReply" href="#" class="btn btn-primary">Reply</a>
        </div>
    </div>
</div>

<script>
function openMsgModal(rowElem) {
    const name = rowElem.querySelector('.full-name').textContent;
    const email = rowElem.querySelector('.full-email').textContent;
    const date = rowElem.querySelector('.full-date').textContent;
    const msgHTML = rowElem.querySelector('.full-msg').innerHTML;
    
    document.getElementById('modalName').textContent = name;
    document.getElementById('modalEmail').textContent = email;
    document.getElementById('modalDate').textContent = date;
    document.getElementById('modalMsg').innerHTML = msgHTML;
    
    const subject = encodeURIComponent("Portfolio Message Reply");
    document.getElementById('modalReply').href = "mailto:" + email + "?subject=" + subject;
    
    document.getElementById('msgModal').classList.add('show');
}

function closeMsgModal(e, force = false) {
    if (force || e.target.id === 'msgModal') {
        document.getElementById('msgModal').classList.remove('show');
    }
}
</script>

<style>
.contact-management {
    padding: 2rem 2rem 4rem;
    max-width: 1200px;
    margin: 0 auto;
    color: var(--text);
    min-height: calc(100vh - var(--nav-h));
    position: relative;
    z-index: 1;
}

.cm-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2.5rem;
}

.cm-header h1 {
    margin: 0;
}

.table-wrap {
    overflow-x: auto;
    background: var(--surface);
    border-radius: var(--radius);
    padding: 1rem;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--border);
}

.cm-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
}

.cm-table th {
    background: var(--surface2);
    color: var(--accent);
    padding: 1.25rem 1rem;
    text-align: left;
    font-weight: 600;
    letter-spacing: 0.05em;
    border-bottom: 2px solid var(--border);
    border-radius: 8px 8px 0 0;
}

.cm-table td {
    padding: 1rem;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
}

.cm-table tr {
    cursor: pointer;
    transition: background var(--trans);
}

.cm-table tr:hover { 
    background: rgba(212, 168, 67, 0.05); 
}

/* Row highlight */
tr.status-unread td { font-weight: 600; color: var(--text-heading); }
tr.status-read td { color: var(--muted); }

.msg-snippet {
    max-width: 250px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Badges */
.badge {
    padding: 0.35rem 0.75rem;
    border-radius: var(--radius-pill);
    font-size: 0.75rem;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border: 1px solid currentColor;
}
.badge-unread  { color: var(--accent); background: var(--accent-soft); }
.badge-read    { color: var(--muted); background: rgba(122, 158, 128, 0.1); }

/* Actions */
.btn-action {
    background: rgba(255, 255, 255, 0.04);
    color: var(--text);
    border: 1px solid rgba(212, 168, 67, 0.22);
    padding: 0.4rem 0.8rem;
    border-radius: var(--radius-pill);
    cursor: pointer;
    font-size: 0.8rem;
    margin-right: 0.5rem;
    transition: all var(--trans);
}
.btn-action:hover {
    background: rgba(212, 168, 67, 0.15);
    color: var(--accent);
    border-color: var(--accent);
}

.btn-del:hover {
    background: rgba(224, 80, 80, 0.15);
    color: var(--danger);
    border-color: var(--danger);
}

.no-messages {
    text-align: center;
    color: var(--muted);
    font-size: 1.1rem;
    margin-top: 3rem;
}

/* Modal */
.modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0, 0, 0, 0.65);
    backdrop-filter: blur(8px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.modal-overlay.show {
    opacity: 1;
    visibility: visible;
}

.modal-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 2.5rem 2rem;
    max-width: 550px;
    width: 90%;
    position: relative;
    box-shadow: 0 40px 80px rgba(0, 0, 0, 0.5);
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.modal-overlay.show .modal-card {
    transform: translateY(0);
}

.modal-close {
    position: absolute;
    top: 1.25rem;
    right: 1.5rem;
    font-size: 2rem;
    line-height: 1;
    cursor: pointer;
    color: var(--muted);
    transition: color var(--trans);
}
.modal-close:hover {
    color: var(--danger);
}

#modalName {
    font-family: "Playfair Display", serif;
    color: var(--text-heading);
    margin-bottom: 0.2rem;
    font-size: 1.8rem;
}

.modal-meta {
    font-size: 0.85rem;
    color: var(--accent);
}

.modal-body {
    color: var(--text);
    line-height: 1.6;
    margin-bottom: 2.5rem;
    font-size: 0.95rem;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
}
</style>

<?php require 'footer.php'; ?>