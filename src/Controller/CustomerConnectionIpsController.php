<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CustomerConnectionIps Controller
 *
 * @property \App\Model\Table\CustomerConnectionIpsTable $CustomerConnectionIps
 *
 * @method \App\Model\Entity\CustomerConnectionIp[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomerConnectionIpsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CustomerConnections'],
        ];
        $customerConnectionIps = $this->paginate($this->CustomerConnectionIps);

        $this->set(compact('customerConnectionIps'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer Connection Ip id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customerConnectionIp = $this->CustomerConnectionIps->get($id, [
            'contain' => ['CustomerConnections'],
        ]);

        $this->set('customerConnectionIp', $customerConnectionIp);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customerConnectionIp = $this->CustomerConnectionIps->newEmptyEntity();
        if ($this->request->is('post')) {
            $customerConnectionIp = $this->CustomerConnectionIps->patchEntity($customerConnectionIp, $this->request->getData());
            if ($this->CustomerConnectionIps->save($customerConnectionIp)) {
                $this->Flash->success(__('The customer connection ip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer connection ip could not be saved. Please, try again.'));
        }
        $customerConnections = $this->CustomerConnectionIps->CustomerConnections->find('list', ['order' => 'name']);
        $this->set(compact('customerConnectionIp', 'customerConnections'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer Connection Ip id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customerConnectionIp = $this->CustomerConnectionIps->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customerConnectionIp = $this->CustomerConnectionIps->patchEntity($customerConnectionIp, $this->request->getData());
            if ($this->CustomerConnectionIps->save($customerConnectionIp)) {
                $this->Flash->success(__('The customer connection ip has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer connection ip could not be saved. Please, try again.'));
        }
        $customerConnections = $this->CustomerConnectionIps->CustomerConnections->find('list', ['order' => 'name']);
        $this->set(compact('customerConnectionIp', 'customerConnections'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer Connection Ip id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customerConnectionIp = $this->CustomerConnectionIps->get($id);
        if ($this->CustomerConnectionIps->delete($customerConnectionIp)) {
            $this->Flash->success(__('The customer connection ip has been deleted.'));
        } else {
            $this->Flash->error(__('The customer connection ip could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
