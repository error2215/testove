<?php
use yii\helpers\Html;
use app\models\User;
/* @var $cvs */


$this->title = 'Cv table'; ?>


<table class="table text-center" style="font-size: 16px; text-align: center">
    <thead class="thead-dark thd">
        <tr>
            <th scope="col" style="text-align: center">User</th>
            <th scope="col" style="text-align: center">Name</th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($cvs as $id => $cv) :
    ?>
                <tr>
                    <td><?= (User::findIdentity($cv->user_id))->username ?></td>
                    <td><?= Html::a($cv->name, ['cv/load', 'source' => $cv->source]) ?></td>
                </tr>
    <?php
     endforeach;
     ?>
    </tbody>
</table>

