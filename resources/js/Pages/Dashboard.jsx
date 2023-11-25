import AppLayout from '@/Layouts/AppLayout';
import { Head } from '@inertiajs/react';
import Home from '@/Pages/Home';
import Container from '@/Components/Container';

export default function Dashboard({ auth }) {
    return (
        <>
            <Head title='Dashboard' />

            <div className='py-12'>
                <Container>
                    <div className='overflow-hidden bg-white shadow-sm sm:rounded-lg'>
                        <div className='p-6 text-gray-900'>You're logged in!</div>
                    </div>
                </Container>
            </div>
        </>
    );
}

Dashboard.layout = (page) => (
    <AppLayout
        header={<h2 className='text-xl font-semibold leading-tight text-gray-800'>Dashboard</h2>}
        children={page}
    />
);
