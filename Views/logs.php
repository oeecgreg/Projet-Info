<?php $this->layout('template', ['title' => 'Logs']) ?>

<div class="container">
    <h1>Journal d'activité</h1>
    
    <table class="brawler-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Auteur</th>
                <th>Action</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($logs as $log): ?>
                <tr>
                    <td><?= $log['date_action'] ?></td>
                    <td><strong><?= $this->e($log['author']) ?></strong></td>
                    <td>
                        <span class="rarity-badge"><?= $log['action_type'] ?></span>
                    </td>
                    <td><?= $this->e($log['description']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>