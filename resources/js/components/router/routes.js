import RegistryDashboard from '~/components/pages/Dashboard'
import DataSources from '~/components/pages/DataSources'
import DataSourceView from '../pages/DataSourceView'

export default [
    { path: '/', component: RegistryDashboard},
    { path: '/datasources', component: DataSources},
    { path: '/datasources/:id', name: 'datasources.view', component: DataSourceView}
]
