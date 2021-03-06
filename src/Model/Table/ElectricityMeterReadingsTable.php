<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ElectricityMeterReadings Model
 *
 * @property \App\Model\Table\AccessPointsTable&\Cake\ORM\Association\BelongsTo $AccessPoints
 *
 * @method \App\Model\Entity\ElectricityMeterReading newEmptyEntity()
 * @method \App\Model\Entity\ElectricityMeterReading newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ElectricityMeterReading[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ElectricityMeterReading get($primaryKey, $options = [])
 * @method \App\Model\Entity\ElectricityMeterReading findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ElectricityMeterReading patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ElectricityMeterReading[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ElectricityMeterReading|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ElectricityMeterReading saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ElectricityMeterReading[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ElectricityMeterReading[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ElectricityMeterReading[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ElectricityMeterReading[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ElectricityMeterReadingsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('electricity_meter_readings');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AccessPoints', [
            'foreignKey' => 'access_point_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->uuid('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->date('reading_date')
            ->allowEmptyDate('reading_date');

        $validator
            ->numeric('reading_value')
            ->allowEmptyString('reading_value');

        $validator
            ->scalar('note')
            ->allowEmptyString('note');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['access_point_id'], 'AccessPoints'), ['errorField' => 'access_point_id']);

        return $rules;
    }
}
