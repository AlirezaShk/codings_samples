# Generated by Django 3.2.7 on 2021-11-02 07:03

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('main', '0019_alter_researcher_email'),
    ]

    operations = [
        migrations.AddField(
            model_name='researcher',
            name='publications_raw',
            field=models.TextField(null=True),
        ),
    ]